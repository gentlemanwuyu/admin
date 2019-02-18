<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/2/18
 * Time: 16:16
 */

namespace App\Modules\Entrust\Repositories\Criteria\Role;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class NameOrDisplayNameOrDescriptionLike implements CriteriaInterface
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
                    ->orWhere('display_name', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        return $model;
    }
}