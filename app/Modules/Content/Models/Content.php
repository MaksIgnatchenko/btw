<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Content
 * @package App\Modules\Content\Models
 * @version November 17, 2017, 1:36 pm UTC
 *
 * @property string key
 * @property string value
 * @property string value1
 * @property string value2
 */
class Content extends Model
{
    /** @var array */
    public $fillable = [
//        'key',
//        'title',
        'value',
    ];
    /** @var string */
    protected $primaryKey = 'key';

    /** @var bool */
    public $incrementing = false;

    /** @var array */
    protected $hidden = ['key', 'created_at', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'key'   => 'string',
        'title' => 'string',
        'value' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'key'   => 'required|max:100',
//        'title' => 'required|max:200',
        'value' => 'required|max:40000',
    ];
}
