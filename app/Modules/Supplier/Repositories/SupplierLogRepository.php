<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 23:19
 */

namespace App\Modules\Supplier\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Supplier\Models\SupplierLog;
use App\Traits\RepositoryTrait;

class SupplierLogRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return SupplierLog::class;
    }
}