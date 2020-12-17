<?php

namespace App\Repositories;

use App\Models\Message;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class MessageRepository
 * @package App\Repositories
 * @version December 13, 2020, 10:50 am UTC
*/

class MessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user',
        'message'
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
        return Message::class;
    }


    public function create($input)
    {
        $user = Auth::guard('api')->user();
        if($user)
        {
            $input['user'] = $user->id;
        }
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $user = Auth::guard('api')->user();
        if($user)
        {
            $input['user'] = $user->id;
        }
        $model->fill($input);

        $model->save();

        return $model;
    }


}
