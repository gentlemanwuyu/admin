<?php
/**
 * Repository类的扩展方法
 *
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/22
 * Time: 19:56
 */

namespace App\Traits;

Trait RepositoryTrait
{
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->model, $method], $parameters);
    }
}