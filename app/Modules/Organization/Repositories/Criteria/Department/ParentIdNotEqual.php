<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/2/22
 * Time: 16:49
 */

namespace App\Modules\Organization\Repositories\Criteria\Department;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ParentIdNotEqual implements CriteriaInterface
{
    public function __construct($parent_id) {
        $this->parent_id = $parent_id;
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
        if(isset($this->parent_id)){
            $model = $model->where('parent_id', '!=', $this->parent_id);
        }

        return $model;
    }
}