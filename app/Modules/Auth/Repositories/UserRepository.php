<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/14
 * Time: 14:12
 */

namespace App\Modules\Auth\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Auth\Models\User;
use App\Traits\RepositoryTrait;

class UserRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return User::class;
    }
}