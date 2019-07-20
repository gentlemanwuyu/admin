<?php
namespace App\Modules\Category\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Category\Services\CategoryService;
use App\Modules\Category\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
	}

    public function index()
    {
        $product_categories = $this->categoryService->getCategoryTree('product');
        $goods_categories = $this->categoryService->getCategoryTree('goods');

        return view('category::category.index', compact('product_categories', 'goods_categories'));
    }

    public function categoryTree($type)
    {
        $categories = $this->categoryService->getCategoryTree($type);

        return view('category::category.category_tree', compact('type', 'categories'));
    }

    public function createOrUpdateCategoryPage(Request $request)
    {
        $data = [];
        if ('update' == $request->get('action')) {
            $category_info = $this->categoryService->getCategory($request->get('category_id'), $request->get('type'));

            $data = array_merge($data, compact('category_info'));
        }

        return view('category::category.create_or_update_category', $data);
    }

    public function createOrUpdateCategory(CategoryRequest $request)
    {
        return response()->json($this->categoryService->createOrUpdateCategory($request));
    }

    public function deleteCategory(Request $request)
    {
        return response()->json($this->categoryService->deleteCategory($request));
    }
}
