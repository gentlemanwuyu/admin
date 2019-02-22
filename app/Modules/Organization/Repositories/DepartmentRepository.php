<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/29
 * Time: 16:39
 */

namespace App\Modules\Organization\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Organization\Models\Department;
use App\Traits\RepositoryTrait;
use App\Modules\Organization\Repositories\Criteria\Department\ParentIdEqual;

class DepartmentRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return Department::class;
    }

    /**
     * 获取部门结构树
     *
     * @return mixed null|object
     */
    public function getTree()
    {
        // 根部门
        $root = $this->findByField('parent_id', 0)->first();
        if (!$root) {
            return null;
        }

        $root->children =  $this->recursiveGetSubDepartments($root->id);

        return $root;
    }

    /**
     * 递归读取下属部门
     *
     * @param $parent_id
     * @param array $fields
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function recursiveGetSubDepartments($parent_id, $fields = ['*'])
    {
        $subs = $this->resetCriteria()->pushCriteria(new ParentIdEqual($parent_id))->get($fields);
        foreach ($subs as $sub) {
            $children = $this->recursiveGetSubDepartments($sub->id, $fields);
            if ($children) {
                $sub->children = $children;
            }
        }

        return $subs->all();
    }
}