<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/6
 * Time: 16:46
 */

namespace App\Modules\Category\Services;

use App\Modules\Category\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
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
                if ($data['parent_id']) {
                    $parent = $this->categoryRepository->find($data['parent_id']);
                    $data['type'] = $parent->type;
                }else {
                    $data['type'] = $request->get('type', 0);
                }
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
     * 删除分类
     *
     * @param $request
     * @return array
     */
    public function deleteCategory($id)
    {
        try {
            $category = $this->categoryRepository->find($id);
            if (!$category->children->isEmpty()) {
                throw new \Exception(trans('category::category.category_can_not_delete_because_sub_category'));
            }

            // TODO: 判断分类下是否含有产品（商品）

            $category->delete();

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}