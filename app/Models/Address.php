<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Address
 * @package App\Models
 * @version December 6, 2020, 11:33 am UTC
 *
 * @property string $lat
 * @property string $lang
 * @property integer $user_id
 */
class Address extends Model
{

    public $table = 'address';




    public $fillable = [
        'lat',
        'lang',
        'user_id',
        'street',
        'governorate',
        'city',
        'building_number',
        'floor_number',
        'flat_number',
        'flag'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'lat' => 'string',
        'lang' => 'string',
        'user_id' => 'integer',
        'building_number' => 'integer',
        'floor_number'=>'integer',
        'flat_number' => 'integer',
        'governorate'=>'string',
        'city'=>'string',
        'flag' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

        'lat' => 'required',
        'lang' => 'required',
        'building_number' => 'required',
        'floor_number'=>'required',
        'flat_number' => 'required',
        'governorate'=>'required',
        'city'=>'required',
        'flag' => 'required'

    ];

    /* Begin Relation */

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    /* End  Relation */
}
