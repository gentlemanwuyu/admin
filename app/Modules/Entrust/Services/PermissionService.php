<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/2/11
 * Time: 18:19
 */

namespace App\Modules\Entrust\Services;

use App\Modules\Entrust\Repositories\PermissionRepository;
use App\Modules\Entrust\Repositories\Criteria\Permission\NameOrDisplayNameOrDescriptionLike;

class PermissionService
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * 权限列表
     *
     * @param $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getList($request)
    {
        $this->permissionRepository->pushCriteria(new NameOrDisplayNameOrDescriptionLike($request->get('search')));

        return $this->permissionRepository->paginate();
    }

    /**
     * 读取所有权限
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->permissionRepository->all();
    }

    /**
     * 获取所有权限类型
     *
     * @return mixed
     */
    public function getPermissionTypes()
    {
        return $this->permissionRepository->getTypes();
    }

    /**
     * 创建/修改权限
     *
     * @param $request
     * @return array
     */
    public function createOrUpdate($request)
    {
        try {
            $data = [
                'type_id' => $request->get('type_id'),
                'name' => $request->get('name'),
                'display_name' => $request->get('display_name'),
                'description' => $request->get('description'),
            ];

            if ('create' == $request->get('action', 'create')) {
                $this->permissionRepository->create($data);
            }elseif ('update' == $request->get('action')) {
                $this->permissionRepository->update($data, $request->get('permission_id'));
            }else {
                throw new \Exception("Unknown action");
            }

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 根据条件读取一条权限数据
     *
     * @param $criteria
     * @return mixed
     */
    public function getPermission($criteria)
    {
        if (is_numeric($criteria)) {
            return $this->permissionRepository->find($criteria);
        }elseif (is_array($criteria)) {
            return $this->permissionRepository->findWhere($criteria)->first();
        }
    }

    /**
     * 删除权限
     *
     * @param $request
     * @return array
     */
    public function delete($request)
    {
        try {
            $this->permissionRepository->delete($request->get('permission_id'));

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}