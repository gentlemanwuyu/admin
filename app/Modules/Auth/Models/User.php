<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/10
 * Time: 19:57
 */

namespace App\Modules\Auth\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $genders = [
        0 => 'unknown',
        1 => 'male',
        2 => 'female',
    ];

    /**
     * gender字段修改器
     *
     * @param $value
     * @return string
     */
    public function getGenderValueAttribute()
    {
        return $this->genders[$this->gender] ?? 'unknown';
    }
}