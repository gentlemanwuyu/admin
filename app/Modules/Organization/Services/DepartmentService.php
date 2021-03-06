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
            $tree = $this->departmentRepository->getTree(['id', 'name']);

            return ['status' => 'success', 'content'=>$tree];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 添加子部门
     *
     * @param $request
     * @return array
     */
    public function add($request)
    {
        try {
            $parent_department = $this->departmentRepository->find($request->get('parent_id'));
            if (!$parent_department) {
                throw new \Exception(trans('organization::department.invalid_parent_department'));
            }

            $this->departmentRepository->create([
                'name' => $request->get('department_name'),
                'parent_id' => $request->get('parent_id'),
            ]);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 修改部门名称
     *
     * @param $request
     * @return array
     */
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
            // 根部门不可以被删除
            $department = $this->departmentRepository->find($department_id);
            if (isset($department->parent_id) && 0 == $department->parent_id) {
                throw new \Exception(trans('organization::department.root_department_cannot_delete'));
            }

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

    /**
     * 拖动部门
     *
     * @param $request
     * @return array
     */
    public function drag($request)
    {
        try {
            $this->departmentRepository->update(['parent_id' => $request->get('parent_id')], $request->get('department_id'));

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}