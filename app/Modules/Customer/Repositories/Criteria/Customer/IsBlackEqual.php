<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/18
 * Time: 13:37
 */

namespace App\Modules\Customer\Repositories\Criteria\Customer;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class IsBlackEqual implements CriteriaInterface
{
    public function __construct($is_black) {
        $this->is_black = $is_black;
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
        if($this->is_black){
            $model = $model->where('is_black', $this->is_black);
        }

        return $model;
    }
}