<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class Message
 * @package App\Models
 * @version December 13, 2020, 10:50 am UTC
 *
 * @property integer $user
 * @property string $message
 */
class Message extends Model
{
    use SoftDeletes;

    public $table = 'messages';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user',
        'message'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */

    public static $rules = [
        'user' => 'required|integer',
        'message' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user');
    }


}
