<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/7/2
 * Time: 15:02
 */

namespace App\Modules\Product\Repositories\Criteria\Product;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class IdNotIn implements CriteriaInterface
{
    public function __construct($ids) {
        $this->ids = $ids;
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
        if($this->ids && is_array($this->ids)){
            $model = $model->whereNotIn('id', $this->ids);
        }

        return $model;
    }
}