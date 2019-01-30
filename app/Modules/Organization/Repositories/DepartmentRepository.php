<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/29
 * Time: 16:39
 */

namespace App\Modules\Organization\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Organization\Models\Department;
use App\Traits\RepositoryTrait;
use App\Modules\Organization\Repositories\Criteria\Department\ParentIdEqual;

class DepartmentRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return Department::class;
    }

    public function getSubDepartment($parent_id, $fields=['*'])
    {
        return $this->resetCriteria()->pushCriteria(new ParentIdEqual($parent_id))->get($fields);
    }
}