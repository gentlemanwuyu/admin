<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/13
 * Time: 11:08
 */

namespace App\Modules\Supplier\Repositories\Criteria\Supplier;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class NameLike implements CriteriaInterface
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
            $model = $model->where('name', 'like', "{$this->name}%");
        }

        return $model;
    }
}