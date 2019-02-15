<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/2/15
 * Time: 15:16
 */

namespace App\Modules\Entrust\Services;

use App\Modules\Entrust\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
}