<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Basket
 * @package App\Models
 * @version December 6, 2020, 11:31 am UTC
 *
 * @property integer $product_id
 * @property integer $user_id
 */
class Basket extends Model
{

    public $table = 'baskets';


    public $fillable = [
        'product_id',
        'user_id',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     *
     */
    public static $rules = [
        'product_id' => 'required',
        'user_id' => 'sometimes',
        ];

}
