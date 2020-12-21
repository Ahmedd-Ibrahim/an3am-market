<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version December 6, 2020, 11:47 am UTC
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
 *
 * */
class OrderRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'price',
        'serial',
        'delivery_price',
        'total_price',
        'process',
        'delivery_date',
        'address_id',
        'user_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     *
     */
    protected $basketProtected,$allDataOnBasket,$purePrice,$purePricePlusDelivery;

    public $delivery_price = 20;

    public function __construct(BasketRepository $basket)
    {
        $this->basketProtected = $basket;

        $this->allDataOnBasket = $this->basketProtected->all();

        $purePrice = $this->basketProtected->totalPrice();

       $this->purePricePlusDelivery = ($purePrice + $this->delivery_price);

    }



    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }

    public function find($id, $columns = ['*'])
    {
//        $query = $this->model->newQuery();

        return Order::findOrFail($id);
    }

    public function create($input)
    {


        $input['serial'] = rand(10000000,99999999);

        if(auth()->guard('api')->user())
        {
            $user = JWTAuth::parseToken()->authenticate();

            $input['user_id'] = $user->id;


        }


        $model = $this->model->newInstance($input);
        $this->InsertProductsOnOrder($model);
        $model->save();

        return $model;

    } // End of create


    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        if(auth()->guard('api')->user())
        {

            $user = JWTAuth::parseToken()->authenticate();

            $order = Order::where('user_id',$user->id)->Where('process','!=','done')->get();

            if(!$order || count($order) < 1)
            {
                return null;
            }

            return $order;

        }

        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);
    } // End of all

    public function history()
    {
        if(auth()->guard('api')->user())
        {
            $user = JWTAuth::parseToken()->authenticate();

            $order = Order::where('user_id',$user->id)->Where('process','=','done')->get();

            if(!$order || count($order) < 1)
            {
                return null;
            }
            return $order;
        }

        return 'You need to login ';
    } // End of history

    public function calc()
    {

        $allDataOnBasket = $this->basketProtected->all();

        $purePrice = $this->basketProtected->totalPrice();

        $purePricePlusDelivery = ($purePrice + $this->delivery_price);

        return $purePricePlusDelivery;
    }

    private function InsertProductsOnOrder($model)
    {
       $counter = $this->allDataOnBasket;

       foreach ($counter as $x)
       {
           $count =  $x->counter;

           $product = Product::find($x->product_id);

           for ($i = 1; $i <= $count; $i++)
           {

               $model->Products()->attach($product);
           }
       }
       return true;
    }
}
