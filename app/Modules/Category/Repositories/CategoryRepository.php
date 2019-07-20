<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/20
 * Time: 15:45
 */

namespace App\Modules\Category\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Category\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }
}