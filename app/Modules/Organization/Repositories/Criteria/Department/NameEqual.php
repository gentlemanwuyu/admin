<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/30
 * Time: 19:54
 */

namespace App\Modules\Organization\Repositories\Criteria\Department;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class NameEqual implements CriteriaInterface
{
    public function __construct($name) {
        $this->name = $name;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if($this->name){
            $model = $model->where('name', $this->name);
        }

        return $model;
    }
}