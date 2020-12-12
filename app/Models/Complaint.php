<?php

namespace App\Models;

use App\User;
//use Eloquent as Model;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Complaint
 * @package App\Models
 * @version November 11, 2020, 9:42 am UTC
 *
 * @property string $name
 * @property string $phone
 * @property string $message
 * @property integer $user_id
 */
class Complaint extends Model
{

    public $table = 'complaints';




    public $fillable = [
        'name',
        'phone',
        'message',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'message' => 'string',
        'phone' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

        'name' => 'required',
        'message' => 'required',
        'phone' => 'required',
        'user_id' => 'required'
    ];

    /* Begin Relations */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /* End  Relations */

}
