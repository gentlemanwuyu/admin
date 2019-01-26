<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/26
 * Time: 10:53
 */

namespace App\Modules\Auth\Repositories\Criteria\User;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class EmailOrNameLike implements CriteriaInterface
{
    public function __construct($search) {
        $this->search = $search;
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
        if($this->search){
            $model = $model->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            });
        }

        return $model;
    }
}