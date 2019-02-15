<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/14
 * Time: 14:03
 */

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Repositories\UserRepository;
use App\Modules\Auth\Repositories\Criteria\User\IsAdminEqual;
use App\Modules\Auth\Repositories\Criteria\User\EmailOrNameLike;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
        $this->userRepository->pushCriteria(new IsAdminEqual(0));
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
            if ($request->has('is_admin')) {
                $data['is_admin'] = $request->get('is_admin');
            }

            if ('create' == $request->get('action')) {
                $data['email'] = $request->get('email');
                $data['password'] = bcrypt(config('project.default_password') ?: 'admin');
                $this->userRepository->create($data);
            }elseif ('update' == $request->get('action')) {
                $this->userRepository->update($data, $request->get('user_id'));
            }

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }


    public function deleteUser($request)
    {
        try {
            $this->userRepository->delete($request->get('user_id'));

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
}