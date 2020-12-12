<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class User
 * @package App\Models
 * @version December 6, 2020, 10:43 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $verified_code
 * @property string $password
 * @property string $role
 * @property string $phone
 * @property string $phone_verified
 */
class User extends Model
{

    public $table = 'users';


    public $fillable = [
        'name',
        'email',
        'verified_code',
        'password',
        'role',
        'phone',
        'phone_verified'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'verified_code' => 'string',
        'password' => 'string',
        'role' => 'string',
        'phone' => 'string',
        'phone_verified' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
