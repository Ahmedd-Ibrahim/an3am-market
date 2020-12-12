<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Settings
 * @package App\Models
 * @version December 6, 2020, 12:09 pm UTC
 *
 * @property string $intro_ar_photo
 * @property string $intro_en_photo
 * @property string $intro_ar_title
 * @property string $intro_en_title
 * @property string $intro_ar_desc
 * @property string $intro_en_desc
 * @property string $about_ar
 * @property string $about_en
 * @property string $condation_ar
 * @property string $condation_en
 * @property string $privcy_ar
 * @property string $privcy_en
 */
class Settings extends Model
{

    public $table = 'settings';




    public $fillable = [
        'intro_ar_photo',
        'intro_en_photo',
        'intro_ar_title',
        'intro_en_title',
        'intro_ar_desc',
        'intro_en_desc',
        'about_ar',
        'about_en',
        'condation_ar',
        'condation_en',
        'privcy_ar',
        'privcy_en'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'intro_ar_photo' => 'string',
        'intro_en_photo' => 'string',
        'intro_ar_title' => 'string',
        'intro_en_title' => 'string',
        'intro_ar_desc' => 'string',
        'intro_en_desc' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'intro_ar_photo' => 'sometimes',
        'intro_en_photo' => 'sometimes',
        'intro_ar_title' => 'required',
        'intro_en_title' => 'required',
        'intro_ar_desc' => 'required',
        'intro_en_desc' => 'required'
    ];


}
