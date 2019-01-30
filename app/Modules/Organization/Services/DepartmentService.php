<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/26
 * Time: 18:03
 */

namespace App\Modules\Organization\Services;

use App\Modules\Organization\Repositories\Criteria\Department\ParentIdEqual;
use App\Modules\Organization\Repositories\Criteria\Department\IdNotEqual;
use App\Modules\Organization\Repositories\Criteria\Department\NameEqual;
use App\Modules\Organization\Repositories\DepartmentRepository;

class DepartmentService
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * 读取部门tree
     *
     * @return array
     */
    public function getTree()
    {
        try {
            $root_deparment = $this->departmentRepository->firstWhere(['parent_id' => 0]);

            if (!$root_deparment) {
                return ['status' => 'success', 'content'=>null];
            }

            $result = new \stdClass;
            $result->id = $root_deparment->id;
            $result->name = $root_deparment->name;
            $result->title = $root_deparment->name;
            $children = $this->getSubDepartments($root_deparment->id);
            if ($children) {
                $result->children = $children;
            }

            return ['status' => 'success', 'content'=>$result];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 递归地读取子部门
     *
     * @param $parent_id
     * @return array|null
     */
    public function getSubDepartments($parent_id)
    {
        if (!$parent_id) {
            return null;
        }
        $result = [];
        $sub_departments = $this->departmentRepository->getSubDepartment($parent_id);

        foreach ($sub_departments as  $department) {
            $item = new \stdClass;
            $item->id = $department->id;
            $item->name = $department->name;
            $item->title = $department->name;
            $children = $this->getSubDepartments($department->id);
            if ($children) {
                $item->children = $children;
            }
            $result[] = $item;
        }

        return $result;
    }

    public function update($request)
    {
        try {
            $result = $this->departmentRepository->pushCriteria(new IdNotEqual($request->get('department_id')))->pushCriteria(new NameEqual($request->get('department_name')))->get();
            if (!$result->isEmpty()) {
                throw new \Exception(trans("organization::department.department_name_exists"));
            }


            $this->departmentRepository->resetCriteria()->update(['name' => $request->get('department_name')], $request->get('department_id'));

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 删除部门
     *
     * @param $department_id
     * @return array
     */
    public function delete($department_id)
    {
        try {
            // 判断该部门下是否还有子部门
            $children = $this->departmentRepository->pushCriteria(new ParentIdEqual($department_id))->get();
            if (!$children->isEmpty()) {
                throw new \Exception(trans('organization::department.can_not_delete_department.have_child'));
            }

            $this->departmentRepository->resetCriteria()->delete($department_id);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}