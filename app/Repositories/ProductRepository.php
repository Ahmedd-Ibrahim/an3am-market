<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version December 6, 2020, 11:22 am UTC
*/

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'desc',
        'sale_price',
        'feature',
        'stock',
        'regular_price',
        'user_id',
        'type_id'
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
        return Product::class;
    }


    public function create($input)
    {
        if(isset($input['image']) & is_file($input['image']))
        {
            $input['image'] = Resize($input['image'],'products',300,300);
        }

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    } // End of create

    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        if(isset($input['image']) & is_file($input['image']))
        {
            RemoveImageFromDisk($model->image);

            $input['image'] = Resize($input['image'],'products',300,300);
        } else {
            $input['image'] = $model->image;
        }

        $model->fill($input);

        $model->save();

        return $model;
    } // End of update

    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        if(isset($model->image))
        {
            RemoveImageFromDisk($model->image);
        }
        return $model->delete();
    } // End of delete

}
