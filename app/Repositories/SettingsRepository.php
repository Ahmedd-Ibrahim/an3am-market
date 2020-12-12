<?php

namespace App\Repositories;

use App\Models\Settings;
use App\Repositories\BaseRepository;

/**
 * Class SettingsRepository
 * @package App\Repositories
 * @version December 6, 2020, 12:09 pm UTC
*/

class SettingsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intro_ar_photo',
        'intro_en_photo',
        'intro_ar_title',
        'intro_en_title',
        'intro_ar_desc',
        'intro_en_desc',
        'about_ar',
        'about_en',
        'condation_ar',
        'condation_en',
        'privcy_ar',
        'privcy_en'
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
        return Settings::class;
    }

    public function create($input)
    {
        if(isset($input['intro_ar_photo']) & is_file($input['intro_ar_photo']))
        {
            $input['intro_ar_photo'] = Resize($input['intro_ar_photo'],'settings',300,300);
        }
        if(isset($input['intro_en_photo']) & is_file($input['intro_en_photo']))
        {
            $input['intro_en_photo'] = Resize($input['intro_en_photo'],'settings',300,300);
        }
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;

    } // End of create

    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        if(isset($input['intro_ar_photo']) && is_file($input['intro_ar_photo']))
        {

            RemoveImageFromDisk($model->intro_ar_photo);

            $input['intro_ar_photo'] = Resize($input['intro_ar_photo'],'settings',300,300);
        }else{
            // if no image on update , append old one
            $input['intro_ar_photo'] = $model->intro_ar_photo;
        }

        if(isset($input['intro_en_photo']) && is_file($input['intro_en_photo']))
        {
            // if no image on update , append old one
            RemoveImageFromDisk($model->intro_en_photo);

            $input['intro_en_photo'] = Resize($input['intro_en_photo'],'settings',300,300);
        }else{
            $input['intro_en_photo'] = $model->intro_en_photo;
        }


        $model->fill($input);

        $model->save();

        return $model;
    } // End of update

    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);
        if(isset($model->intro_ar_photo))
        {
            RemoveImageFromDisk($model->intro_ar_photo);
        }

        if(isset($model->intro_en_photo))
        {
            RemoveImageFromDisk($model->intro_en_photo);
        }

        return $model->delete();
    } // End of delete
}
