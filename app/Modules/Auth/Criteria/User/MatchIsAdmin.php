<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/15
 * Time: 10:55
 */

namespace App\Modules\Auth\Criteria\User;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class MatchIsAdmin implements CriteriaInterface
{
    public function __construct($is_admin) {
        $this->is_admin = $is_admin;
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
        if(isset($this->is_admin)){
            $model = $model->where('is_admin', $this->is_admin);
        }
        return $model;
    }
}