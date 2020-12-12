<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProductOrder
 * @package App\Models
 * @version December 6, 2020, 11:55 am UTC
 *
 * @property integer $product_id
 * @property integer $order_id
 * @property integer $count
 * @property number $price
 */
class ProductOrder extends Model
{

    public $table = 'product_order';
    



    public $fillable = [
        'product_id',
        'order_id',
        'count',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'order_id' => 'integer',
        'count' => 'integer',
        'price' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
