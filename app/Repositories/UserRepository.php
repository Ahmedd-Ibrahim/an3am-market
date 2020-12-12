<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version December 6, 2020, 10:43 am UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'verified_code',
        'password',
        'role',
        'phone',
        'phone_verified'
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
        return User::class;
    }

    public function create($input)
    {
        $input['password'] = bcrypt($input['password']);

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    } // end of create

    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $input['password'] = bcrypt($input['password']);

        $model->fill($input);

        $model->save();

        return $model;
    } // end of update


    public function find($id, $columns = ['*'])
    {
        $user = Auth::guard('api')->user();

        if ($user)
        {
            $id = Auth::guard('api')->user()->id;
            $address = $user->Address;
            $query = $this->model->newQuery();
            $data = $query->find($id, $columns);
            $data['address'] = $address;
            return $data;
        }

        $query = $this->model->newQuery();
        return $query->find($id, $columns);

    } // end of find [profile on api]


}
