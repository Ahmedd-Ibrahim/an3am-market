<?php

namespace App\Repositories;

use App\Models\Basket;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class BasketRepository
 * @package App\Repositories
 * @version December 6, 2020, 11:31 am UTC
*/

class BasketRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'user_id'
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
        return Basket::class;
    }

    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        if(auth()->guard('api')->user())

        {
            $user = JWTAuth::parseToken()->authenticate();

            $productId_count = DB::select('SELECT  product_id , COUNT(*) AS counter FROM  baskets where user_id ='. $user->id .' GROUP BY product_id ORDER BY counter desc' );

            return $productId_count;

        }

        return 'You need to login ';
    }


    public function create($input)
    {
        if(auth()->guard('api')->user()) {
            $product = Product::find($input['product_id']);
            if(!$product)
            {
                return  'wrong Id';
            }
            $user = JWTAuth::parseToken()->authenticate();
            $input['user_id'] = $user->id;

            $sameProductInBasket = $user->Basket()->where('product_id','=',$product->id)->get();
            if($sameProductInBasket)
            {
                if($product->stock > count($sameProductInBasket))
                {

                    $user->Basket()->attach($product);
                }else{
                    return $message = '';
                }
            }

            return $message = 'Added To sock';
        }

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    } // end of create


    public function totalPrice()
    {
        if(auth()->guard('api')->user()) {

            $user = JWTAuth::parseToken()->authenticate();

            return $user->Basket()->sum('regular_price');

        }
    }

    public function clearBasket()
    {
        if(auth()->guard('api')->user()) {

            $user = JWTAuth::parseToken()->authenticate();

            $user->Basket()->wherePivot('user_id','=',$user->id)->detach();
             return 'done';
        }
    }

}
