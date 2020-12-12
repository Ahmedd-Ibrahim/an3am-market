<?php

namespace App\Repositories;

use App\Models\Basket;
use App\Repositories\BaseRepository;

/**
 * Class BasketRepository
 * @package App\Repositories
 * @version December 6, 2020, 11:31 am UTC
*/

class BasketRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'user_id'
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
        return Basket::class;
    }
}
