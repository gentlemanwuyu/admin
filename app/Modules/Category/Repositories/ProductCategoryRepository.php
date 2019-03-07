<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/6
 * Time: 16:52
 */

namespace App\Modules\Category\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Category\Models\ProductCategory;
use App\Traits\RepositoryTrait;
use App\Modules\Category\Repositories\Criteria\ProductCategory\ParentIdEqual;

class ProductCategoryRepository extends BaseRepository
{
    use RepositoryTrait;

    public function model()
    {
        return ProductCategory::class;
    }

    /**
     * 递归读取子分类
     *
     * @param $parent_id
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getSubCategories($parent_id)
    {
        $categories = $this->resetCriteria()->pushCriteria(new ParentIdEqual($parent_id))->get()->all();
        if ($categories) {
            foreach ($categories as $category) {
                $sub_categories = $this->getSubCategories($category->id);
                if ($sub_categories) {
                    $category->children = $sub_categories;
                }
            }
        }

        return $categories;
    }
}