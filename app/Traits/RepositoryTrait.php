<?php
/**
 * Repository类的扩展方法
 *
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/22
 * Time: 19:56
 */

namespace App\Traits;

Trait RepositoryTrait
{
    /**
     * 根据条件取出一条记录
     *
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function firstWhere(array $where, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        $model = $this->model->first($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }
}