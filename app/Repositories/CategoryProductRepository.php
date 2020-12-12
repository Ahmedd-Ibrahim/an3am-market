<?php

namespace App\Repositories;

use App\Models\CategoryProduct;
use App\Repositories\BaseRepository;

/**
 * Class CategoryProductRepository
 * @package App\Repositories
 * @version December 6, 2020, 11:59 am UTC
*/

class CategoryProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'product_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CategoryProduct::class;
    }
}
