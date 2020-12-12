<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Slider
 * @package App\Models
 * @version December 6, 2020, 12:03 pm UTC
 *
 * @property string $image
 * @property string $title
 * @property string $range
 */
class Slider extends Model
{

    public $table = 'sliders';




    public $fillable = [
        'image',
        'title',
        'range'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'string',
        'title' => 'string',
        'range' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'sometimes|mimes:jpeg,jpg,png',
        'title' => 'required',
        'range' => 'sometimes'
    ];


}
