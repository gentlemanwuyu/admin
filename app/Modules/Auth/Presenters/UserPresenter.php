<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/4
 * Time: 14:15
 */

namespace App\Modules\Auth\Presenters;

class UserPresenter
{
    public function displayIsAdmin($value)
    {
        if (1 == $value) {
            return 'yes';
        }else {
            return 'no';
        }
    }
}