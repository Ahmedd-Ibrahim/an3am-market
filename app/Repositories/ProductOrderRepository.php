<?php

namespace App\Repositories;

use App\Models\ProductOrder;
use App\Repositories\BaseRepository;

/**
 * Class ProductOrderRepository
 * @package App\Repositories
 * @version December 6, 2020, 11:55 am UTC
*/

class ProductOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'order_id',
        'count',
        'price'
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
        return ProductOrder::class;
    }
}
