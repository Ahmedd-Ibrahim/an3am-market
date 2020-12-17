<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class AddressRepository
 * @package App\Repositories
 * @version December 6, 2020, 11:33 am UTC
*/

class AddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'lat',
        'lang',
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
        return Address::class;
    }

    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {

        $user = Auth::guard('api')->user();
        if($user)
        {
            $address = Address::where('user_id',$user->id)->get();
            if (!$address || count($address) < 1)
            {
                return null;
            }
            return $address;
        }


        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);


    }

    public function create($input)
    {
        $user = Auth::guard('api')->user();
        if($user)
        {
            $input['user_id'] = $user->id;
        }
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

}
