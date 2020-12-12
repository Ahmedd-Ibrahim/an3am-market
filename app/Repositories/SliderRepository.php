<?php

namespace App\Repositories;

use App\Models\Slider;
use App\Repositories\BaseRepository;

/**
 * Class SliderRepository
 * @package App\Repositories
 * @version December 6, 2020, 12:03 pm UTC
*/

class SliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
        'title',
        'range'
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
        return Slider::class;
    }

    public function create($input)
    {
        if(isset($input['image']) & is_file($input['image']))
        {
            $input['image'] = Resize($input['image'],'sliders',300,300);
        }
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    } // End of create

    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        if(isset($input['image']) && is_file($input['image']))
        {

            RemoveImageFromDisk($model->image);

            $input['image'] = Resize($input['image'],'sliders',300,300);
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
