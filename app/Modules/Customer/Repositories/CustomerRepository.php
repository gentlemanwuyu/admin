<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/16
 * Time: 20:15
 */

namespace App\Modules\Customer\Repositories;

use App\Traits\RepositoryTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Customer\Models\Customer;

class CustomerRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return Customer::class;
    }
}