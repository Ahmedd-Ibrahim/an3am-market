<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProccessRepository;
use App\Models\Product;
use App\Models\Settings;
use App\Repositories\BaseRepository;

/**
 * Class OrderProcessRepositoryRepository
 * @package App\Repositories
 * @version December 15, 2020, 10:02 am UTC
*/


/*
 * get the basket data  [products id & how many of every product ]
 *
 * check if this products stock is allowed [if not allowed tell me how many allowed for every product]
 *
 *
 * make order & insert this products inside order relation
 *
 *
 * calc total price for all products inside the order then update the order with [total price + delivery price]
 *
 *
 * update product stock with new stock count
 *
 *
 * clear user basket
 *
 * */

class OrderProcessRepositoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderProcessRepositoryRepository::class;
    }

    public $basketProtected,
        $allDataOnBasket,
        $purePrice,
        $purePricePlusDelivery,
        $errors = [],
        $order,
        $products=[],
        $delivery_price

;


    public function __construct(BasketRepository $basket)
    {
        $this->basketProtected = $basket;

        $this->allDataOnBasket = $this->basketProtected->all();

        $this->purePrice = $this->basketProtected->totalPrice();

        $this->purePricePlusDelivery = ($this->purePrice + $this->delivery_price);

        $this->delivery_price = $this->deliveryPrice();
    }

    /*
     * get products id from basket
     *
     * @return array of products id
     *
     * */

    public function getProductsId()
    {

        $products = $this->allDataOnBasket;
        $ids= [];
        foreach ($products as $product)
        {
            $ids[] = $product->product_id;
        }
        return $ids;
    }

    /*
     * count of products for every id
     *
     * @return array [products => count]
     *
     * */
    public function productCounterForEveryId()
    {
        $products = $this->allDataOnBasket;

        $data  = [];

        foreach ($products as $product)
        {

            $data[] = [$product->counter];

        }

        return $data;
    }

    public function StartNewOrder()
    {

        $products = $this->allDataOnBasket;

        if(!$products)
        {
             $this->errors[] = 'no thing on the basket';
             return 'check basket';
        }

       foreach ($products as $data)
       {
           $product = Product::find($data->product_id);
           if ($product->stock < $data->counter)
           {
                $this->errors[] = ['product_id: '.$product->id => 'can not more than  ' . $product->stock];
           }
       }

        if(count($this->errors) > 0)
        {
            return $this->errors;
        }
        return $this->makeOrder();


    } // End of check product Stock

    /*
     * fetch products Id
     * @return array
     *
     * */
    public function products()
    {
        $productsInBasket = $this->allDataOnBasket;

        foreach ($productsInBasket as $data)
        {
            for ($i = 1; $i <= $data->counter; $i++)
            {

                $this->products[]  = $data->product_id;
            }

        }

        return $this->products;

    }

    public function makeOrder()
    {
        if(!count($this->errors) > 0)
        {
              $order  = Order::create([
                    'price' => $this->purePrice,
                    'serial' => rand(10000000,99999999),
                    'user_id' => 1,
                    'address_id' =>2

                ]);

              return $this->sendError('');
             return $this->InsertProductsOnOrder($order);
        }

        return $this->errors;
    }

    public function InsertProductsOnOrder($order)
    {
        $products = $this->products();

        $order->Products()->attach($products);

        $this->orderPrice($order);

        $this->UpdateProductWithNewStock();

        $this->basketProtected->clearBasket();

        return 'order Added';
    } // End of InsertProductsOnOrder

    public function orderPrice($order)
    {
        if($order)
        {
            $price =  $order->Products()->sum('regular_price');

            $totalPrice = ($price + $this->delivery_price);

            $order->update(['price' => $price,'delivery_price'=>$this->delivery_price,'total_price' => $totalPrice]);

            return $price;
        }else{
            return 0;
        }
    } // End of order Price

    public function UpdateProductWithNewStock()
    {
        $products = $this->allDataOnBasket;
        foreach ($products as $product)
        {
            $productsFromDb= Product::find($product->product_id);
            $newStock = ($productsFromDb->stock - $product->counter);
            $arr []= $productsFromDb->update(['stock'=>$newStock]);
        }

    }

    public function deliveryPrice()
    {
        $price = Settings::first();
        if (!$price)
        {
            return 0;
        }
        return $price->delivery_price;
    }


}
