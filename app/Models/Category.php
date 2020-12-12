<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Category
 * @package App\Models
 * @version December 6, 2020, 11:57 am UTC
 *
 * @property string $name
 */
class Category extends Model
{

    public $table = 'categories';




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

        'name' => 'required'
    ];

    /* Begin Relations */
    public function Products()
    {
        return $this->belongsToMany(Product::class,'category_product');
    }
    /* End  Relations */
}
