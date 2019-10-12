<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 8:54
 */

namespace App\Modules\Supplier\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Supplier\Models\Supplier;
use App\Traits\RepositoryTrait;

class SupplierRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return Supplier::class;
    }
}