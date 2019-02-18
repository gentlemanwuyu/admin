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
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use SoftDeletes, EntrustUserTrait{
        // 用SoftDeletes的restore方法替换掉EntrustUserTrait中的restore方法
        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::can as entrust_can;
    }

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * gender字段对应的性别
     *
     * @var array
     */
    protected $genders = [
        0 => 'unknown',
        1 => 'male',
        2 => 'female',
    ];

    /**
     * gender属性访问器
     *
     * @param $gender
     * @return string
     */
    public function getGenderAttribute()
    {
        return $this->genders[$this->gender_id] ?? 'unknown';
    }

    /**
     * 重写can方法
     *
     * @param string $permission
     * @param bool $requireAll
     * @return bool
     */
    public function can($permission, $requireAll = false)
    {
        return !config('project.check_entrust') || $this->entrust_can($permission, $requireAll);
    }
}