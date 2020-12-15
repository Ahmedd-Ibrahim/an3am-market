<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Order
 * @package App\Models
 * @version December 6, 2020, 11:47 am UTC
 *
 * @property number $price
 * @property string $serial
 * @property number $delivery_price
 * @property number $total_price
 * @property string $process
 * @property string $deliveried_date
 * @property integer $address_id
 * @property integer $user_id
 */
class Order extends Model
{

    public $table = 'orders';


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'float',
        'serial' => 'integer',
        'delivery_price' => 'float',
        'total_price' => 'float',
        'process' => 'string',
        'delivery_date' => 'date',
        'address_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'price' => 'required',
//        'serial' => 'required',
//        'delivery_price' => 'required',
//        'total_price' => 'required',
//        'process' => 'required',
//        'delivery_date' => 'required',
        'address_id' => 'required',
        'user_id' => 'required'

    ];

    /* Begin Relations */

    public function Products()
    {
        return $this->belongsToMany(Product::class,'product_order','order_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    /* End Relations */


}
