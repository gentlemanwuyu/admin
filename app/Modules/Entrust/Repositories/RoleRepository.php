<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/2/15
 * Time: 15:21
 */

namespace App\Modules\Entrust\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Entrust\Models\Role;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return Role::class;
    }
}