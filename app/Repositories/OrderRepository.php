<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version December 6, 2020, 11:47 am UTC
*/

class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'price',
        'serial',
        'delivery_price',
        'total_price',
        'process',
        'delivery_date',
        'address_id',
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
        return Order::class;
    }

    public function create($input)
    {
        $input['serial'] = rand(10000000,99999999);

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    } // End of create
}
