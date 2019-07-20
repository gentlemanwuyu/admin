<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/6
 * Time: 16:46
 */

namespace App\Modules\Category\Services;

use App\Modules\Category\Repositories\Criteria\Category\ParentIdEqual;
use App\Modules\Category\Repositories\ProductCategoryRepository;
use App\Modules\Category\Repositories\GoodsCategoryRepository;
use App\Modules\Category\Repositories\CategoryRepository;

class CategoryService
{
    protected $productCategoryRepository;
    protected $goodsCategoryRepository;
    protected $categoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepository, GoodsCategoryRepository $goodsCategoryRepository, CategoryRepository $categoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->goodsCategoryRepository = $goodsCategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getRepository($type)
    {
        if ('product' == $type) {
            return $this->productCategoryRepository;
        }elseif ('goods') {
            return $this->goodsCategoryRepository;
        }
    }

    /**
     * 获取分类树
     *
     * @param $type
     * @return mixed
     */
    public function getCategoryTree($type)
    {
        return $this->getRepository($type)->getSubCategories(0);
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
                $data['type'] = $request->get('type', 0);
            }

            if ('create' == $request->get('action')) {
                $this->categoryRepository->create($data);
            }elseif ('update' == $request->get('action')) {
                $this->categoryRepository->update($data, $request->get('category_id'));
            }

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 读取分类信息
     *
     * @param $category_id
     * @param string $type
     * @return mixed
     */
    public function getCategory($category_id, $type = 'product')
    {
        return $this->getRepository($type)->find($category_id);
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

            $this->getRepository($request->get('type'))->resetCriteria()->delete($request->get('category_id'));

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

        $sub_categories = $this->getRepository($type)->resetCriteria()->pushCriteria(new ParentIdEqual($category_id))->get();
        if (!$sub_categories->isEmpty()) {
            $result = false;
        }

        return $result;
    }
}