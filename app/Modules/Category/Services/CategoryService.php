<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/6
 * Time: 16:46
 */

namespace App\Modules\Category\Services;

use App\Modules\Category\Repositories\Criteria\ProductCategory\ParentIdEqual;
use App\Modules\Category\Repositories\ProductCategoryRepository;

class CategoryService
{
    protected $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    /**
     * 获取产品分类树
     *
     * @return mixed
     */
    public function getProductCategoryTree()
    {
        return $this->productCategoryRepository->getSubCategories(0);
    }

    /**
     * 创建/修改分类
     *
     * @param $request
     * @return array
     */
    public function createOrUpdateCategory($request)
    {
        try {
            $data = [
                'name' => $request->get('name'),
                'display_name' => $request->get('display_name'),
                'description' => $request->get('description'),
            ];

            if ('create' == $request->get('action')) {
                $data['parent_id'] = $request->get('parent_id', 0);
            }

            $categoryRepository = 'product' == $request->get('type') ? $this->productCategoryRepository : null;

            if ('create' == $request->get('action')) {
                $categoryRepository->create($data);
            }elseif ('update' == $request->get('action')) {
                $categoryRepository->update($data, $request->get('category_id'));
            }

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 读取产品分类信息
     *
     * @param $category_id
     * @return mixed
     */
    public function getProductCategory($category_id)
    {
        return $this->productCategoryRepository->find($category_id);
    }

    /**
     * 删除分类
     *
     * @param $request
     * @return array
     */
    public function deleteCategory($request)
    {
        try {
            $result = $this->isCategoryCanDelete($request->get('category_id'), $request->get('type'));
            if (!$result) {
                throw new \Exception(trans('category::category.category_can_not_delete_because_sub_category'));
            }

            $categoryRepository = 'product' == $request->get('type') ? $this->productCategoryRepository : null;

            $categoryRepository->resetCriteria()->delete($request->get('category_id'));

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 判断分类是否能删除
     *
     * @param $category_id
     * @param string $type
     * @return bool
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function isCategoryCanDelete($category_id, $type = 'product')
    {
        $result = true;

        if ('product' == $type) {
            $sub_categories = $this->productCategoryRepository->resetCriteria()->pushCriteria(new ParentIdEqual($category_id))->get();
            if (!$sub_categories->isEmpty()) {
                $result = false;
            }
        }

        return $result;
    }
}