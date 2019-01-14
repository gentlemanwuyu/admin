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

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }
}