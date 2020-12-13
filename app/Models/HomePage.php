<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class HomePage
 * @package App\Models
 * @version December 7, 2020, 3:07 pm UTC
 *
 */
class HomePage extends Model
{

    public $table = 'home_pages';



    public $fillable = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
