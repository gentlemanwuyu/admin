<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/20
 * Time: 15:45
 */

namespace App\Modules\Category\Repositories;

use App\Modules\Category\Models\Category;

class CategoryRepository extends ProductCategoryRepository
{
    public function model()
    {
        return Category::class;
    }
}