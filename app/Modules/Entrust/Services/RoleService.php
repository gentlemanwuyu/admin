<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/2/15
 * Time: 15:16
 */

namespace App\Modules\Entrust\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Entrust\Repositories\RoleRepository;
use App\Modules\Entrust\Repositories\Criteria\Role\NameOrDisplayNameOrDescriptionLike;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * 角色列表
     *
     * @param $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getList($request)
    {
        $this->roleRepository->pushCriteria(new NameOrDisplayNameOrDescriptionLike($request->get('search')));

        return $this->roleRepository->paginate();
    }

    /**
     * 添加/修改角色
     *
     * @param $request
     * @return array
     */
    public function createOrUpdate($request)
    {
        try {
            $data = [
                'name' => $request->get('name'),
                'display_name' => $request->get('display_name'),
                'description' => $request->get('description'),
            ];

            DB::beginTransaction();

            if ('create' == $request->get('action')) {
                $role = $this->roleRepository->create($data);
            }else {
                $role = $this->roleRepository->update($data, $request->get('role_id'));
            }
            $role->perms()->sync($request->get('permissions'));

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 读取一个角色
     *
     * @param $criteria
     * @return mixed
     */
    public function getRole($criteria)
    {
        if (is_numeric($criteria)) {
            return $this->roleRepository->find($criteria);
        }elseif (is_array($criteria)) {
            return $this->roleRepository->findWhere($criteria)->first();
        }
    }

    /**
     * 删除角色
     *
     * @param $request
     * @return array
     */
    public function delete($request)
    {
        try {
            $this->roleRepository->delete($request->get('role_id'));

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}