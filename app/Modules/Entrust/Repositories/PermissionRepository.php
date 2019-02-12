<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/2/11
 * Time: 18:21
 */

namespace App\Modules\Entrust\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Entrust\Models\Permission;
use App\Traits\RepositoryTrait;

class PermissionRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return Permission::class;
    }
}