<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/17
 * Time: 14:03
 */

namespace App\Modules\Customer\Repositories;

use App\Traits\RepositoryTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Customer\Models\CustomerLog;

class CustomerLogRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return CustomerLog::class;
    }
}