<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/22
 * Time: 16:02
 */

namespace App\Modules\Product\Repositories\Criteria\Product;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class CodeOrNameLike implements CriteriaInterface
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
                $query->where('code', 'like', "%{$this->search}%")
                    ->orWhere('name', 'like', "%{$this->search}%");
            });
        }

        return $model;
    }
}