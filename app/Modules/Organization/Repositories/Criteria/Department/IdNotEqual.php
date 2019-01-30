<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/30
 * Time: 19:52
 */

namespace App\Modules\Organization\Repositories\Criteria\Department;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class IdNotEqual implements CriteriaInterface
{
    public function __construct($id) {
        $this->id = $id;
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
        if(isset($this->id)){
            $model = $model->where('id', '!=', $this->id);
        }

        return $model;
    }
}