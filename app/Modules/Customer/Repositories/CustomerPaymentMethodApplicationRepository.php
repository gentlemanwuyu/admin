<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/19
 * Time: 17:41
 */

namespace App\Modules\Customer\Repositories;

use App\Traits\RepositoryTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Customer\Models\CustomerPaymentMethodApplication;

class CustomerPaymentMethodApplicationRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return CustomerPaymentMethodApplication::class;
    }
}