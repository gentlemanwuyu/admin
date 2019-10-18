<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/14
 * Time: 14:03
 */

namespace App\Modules\Auth\Services;

use Illuminate\Support\Facades\Auth;
use App\Events\UserDeleted;
use App\Modules\Auth\Repositories\UserRepository;
use App\Modules\Entrust\Repositories\RoleRepository;
use App\Modules\Organization\Repositories\DepartmentRepository;
use App\Modules\Auth\Repositories\Criteria\User\IsAdminEqual;
use App\Modules\Auth\Repositories\Criteria\User\EmailOrNameLike;

class AuthService
{
    protected $userRepository;
    protected $roleRepository;
    protected $departmentRepository;

    protected $user;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository, DepartmentRepository $departmentRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->departmentRepository = $departmentRepository;
        $this->user = Auth::user();
    }

    /**
     * 修改密码
     *
     * @param $new_password
     * @param $user_id
     * @return mixed
     */
    public function modifyPassword($new_password, $user_id)
    {
        return $this->userRepository->update(['password' => bcrypt($new_password),], $user_id);
    }

    /**
     * 读取用户列表
     *
     * @param $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getUserList($request)
    {
        if (!$this->user->is_admin) {
            $this->userRepository->pushCriteria(new IsAdminEqual(0));
        }
        if ($request->get('search')) {
            $this->userRepository->pushCriteria(new EmailOrNameLike($request->get('search')));
        }

        return $this->userRepository->paginate();
    }

    /**
     * 创建/修改用户
     *
     * @param $request
     * @return array
     */
    public function createOrUpdateUser($request)
    {
        try {
            $data = [
                'name' => $request->get('name'),
                'gender_id' => $request->get('gender_id'),
                'telephone' => $request->get('telephone'),
            ];
            if ($request->get('birthday')) {
                $data['birthday'] = $request->get('birthday');
            }

            $roles = $request->get('roles', []);
            if ($request->get('is_admin')) {
                $data['is_admin'] = $request->get('is_admin');
                $data['department_id'] = 0;
                $data['is_leader'] = 0;
                $roles = [];
            }else {
                $data['department_id'] = $request->get('department_id');
                if ($request->has('is_leader')) {
                    $data['is_leader'] = $request->get('is_leader');
                }
            }

            if ('create' == $request->get('action')) {
                $data['email'] = $request->get('email');
                $data['password'] = bcrypt(config('project.default_password') ?: 'admin');
                $user = $this->userRepository->create($data);
            }elseif ('update' == $request->get('action')) {
                $user = $this->userRepository->update($data, $request->get('user_id'));
            }
            $user->roles()->sync($roles);

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 刪除用戶
     *
     * @param $request
     * @return array
     */
    public function deleteUser($request)
    {
        try {
            $this->userRepository->delete($request->get('user_id'));

            // 出发用户删除事件
            event(new UserDeleted($request->get('user_id')));

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 根据条件读取一条用户数据
     *
     * @param $criteria
     * @return mixed
     */
    public function getUser($criteria)
    {
        if (is_numeric($criteria)) {
            return $this->userRepository->find($criteria);
        }elseif (is_array($criteria)) {
            return $this->userRepository->findWhere($criteria)->first();
        }
    }

    /**
     * 读取所有角色
     *
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roleRepository->all();
    }

    /**
     * 读取部门树
     *
     * @return mixed
     */
    public function getDepartments()
    {
        return $this->departmentRepository->getDepartmentsExceptRoot();
    }

    /**
     * 获取所有非管理员账号
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getUsersWithoutAdmin()
    {
        $this->userRepository->pushCriteria(new IsAdminEqual(0));

        return $this->userRepository->all();
    }

    public static function isAdmin()
    {
        return 1 == Auth::user()->is_admin;
    }
}