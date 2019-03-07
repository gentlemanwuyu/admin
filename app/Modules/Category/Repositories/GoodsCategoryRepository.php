<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/7
 * Time: 19:43
 */

namespace App\Modules\Category\Repositories;

use App\Modules\Category\Models\GoodsCategory;

class GoodsCategoryRepository extends ProductCategoryRepository
{
    public function model()
    {
        return GoodsCategory::class;
    }
}