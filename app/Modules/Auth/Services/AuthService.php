<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/14
 * Time: 14:03
 */

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Repositories\UserRepository;

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
}