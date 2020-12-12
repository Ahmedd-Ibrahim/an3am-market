<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductUser;
use App\Repositories\BaseRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class ProductUserRepository
 * @package App\Repositories
 * @version December 6, 2020, 11:29 am UTC
*/

class ProductUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'user_id',
        'favourite',

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

        return Product::class;
    }

// get all favorite for current user
    public function favourite()
    {

        if(auth()->guard('api')->user())
        {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user)
            {
                return $this->sendError('login in first');

            }
            return $user->FavouriteProducts;
        }

    } // End of favourite


    public function create($input)
    {

        if(auth()->guard('api')->user())
        {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user)
            {
                return $this->sendError('login in first');

            }

            $product = Product::find($input['product_id']);

            if(!$product)
            {
                return;
            }

             $user->FavouriteProducts()->syncWithoutDetaching($product);

            return $product;
        }



    } // End of create


    public function delete($id)
    {

        $product = Product::find($id);
        if(!$product)
        {
            return null;
        }
        if(auth()->guard('api')->user())
        {
            $user = JWTAuth::parseToken()->authenticate();
           $user->FavouriteProducts()->Detach($product);

           return  'done';

        }


    } // end of delete
}
