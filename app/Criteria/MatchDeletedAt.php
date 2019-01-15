<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/15
 * Time: 12:33
 */

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class MatchDeletedAt implements CriteriaInterface
{

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
        $model = $model->whereNull('deleted_at');

        return $model;
    }
}