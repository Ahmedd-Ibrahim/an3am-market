<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Type
 * @package App\Models
 * @version December 6, 2020, 11:26 am UTC
 *
 * @property string $name
 */
class Type extends Model
{

    public $table = 'types';




    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    /* Begin Relations */

    public function Products()
    {
        return $this->hasMany(Product::class,'type_id');
    }
    /* End Relations */

}
