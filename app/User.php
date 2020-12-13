<?php

namespace App;

use App\Models\Address;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password','role','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','pivot'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }



    /* Begin Relation */

    // his own products
    public function Products()
    {
        return $this->hasMany(Product::class,'user_id');
    }

    public function FavouriteProducts()
    {
        return $this->belongsToMany(Product::class,'product_user');
    }

    public function Basket()
    {
        return $this->belongsToMany(Product::class,'baskets');
    }

    public function Address()
    {
        return $this->hasMany(Address::class,'user_id');
    }

    public function Orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }

    public function Messages()
    {
        return $this->hasMany(Message::class,'user');
    }
    /* End Relation  */


}
