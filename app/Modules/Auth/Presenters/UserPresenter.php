<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/25
 * Time: 16:25
 */

namespace App\Modules\Auth\Presenters;

class UserPresenter
{
    /**
     * users表gender字段对应的性别
     *
     * @var array
     */
    protected $genders = [
        0 => 'unknown',
        1 => 'male',
        2 => 'female',
    ];

    /**
     * gender字段转换
     *
     * @param $gender
     * @return string
     */
    public function getGenderValue($gender)
    {
        return $this->genders[$gender] ?? 'unknown';
    }
}