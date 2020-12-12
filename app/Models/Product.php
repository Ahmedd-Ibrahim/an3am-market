<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

use Eloquent as Model;

/**
 * Class Product
 * @package App\Models
 * @version December 6, 2020, 11:22 am UTC
 *
 * @property string $name
 * @property string $desc
 * @property number $sale_price
 * @property string $featuter
 * @property integer $stock
 * @property number $regular_price
 * @property integer $user_id
 * @property integer $type_id
 */
class Product extends Model
{

    public $table = 'products';
    protected $hidden = ['pivot'];
    public $appends = ['favourite'];

    public $fillable = [
        'name',
        'image',
        'desc',
        'age',
        'sale_price',
        'feature',
        'stock',
        'regular_price',
        'user_id',
        'type_id',
        'favourite'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'image' => 'string',
        'desc' => 'string',
        'age' => 'integer',
        'sale_price' => 'float',
        'feature' => 'string',
        'stock' => 'integer',
        'regular_price' => 'float',
        'user_id' => 'integer',
        'type_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'image'=> 'sometimes',
        'desc' => 'required',
        'age' => 'required',
        'sale_price' => 'required',
        'feature' => 'required',
        'stock' => 'required',
        'regular_price' => 'required',
        'user_id' => 'required',
        'type_id' => 'required'
    ];

    /* Begin Relations */

    // owner of this product
    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function FavouriteUsers()
    {
        return $this->belongsToMany(User::class,'product_user');
    }

    public function UserBasket()
    {
        return $this->belongsToMany(User::class,'baskets');
    }

    public function Orders()
    {
        return $this->belongsToMany(Order::class,'product_order');
    }

    public function Categories()
    {
        return $this->belongsToMany(Category::class,'category_product');
    }

    public function Type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }
    /* End Relations */



    public function getFavouriteAttribute()
    {
        if(auth()->guard('api')->user())
        {
            $user = Auth::user() ?? JWTAuth::parseToken()->authenticate();
            if($user)
            {
                // if this store id exists in store ids relation [favourite relation ]
                $userStores = $user->FavouriteProducts()->find($this->id);
                if($userStores)
                {
                    return true;
                }else{
                    return false;
                }

            } // End of if auth
            else{
                return false;
            }
        }else{
            return false;
        }

    } // End of favourite attr
}
