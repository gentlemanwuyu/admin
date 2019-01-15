<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/15
 * Time: 14:24
 */

namespace App\Modules\Auth\Criteria\User;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class MatchEmailOrName implements CriteriaInterface
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