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

    public function productCategoryTree()
    {
        $product_categories = $this->categoryService->getProductCategoryTree();

        return view('category::category.product_category_tree', compact('product_categories'));
    }

    public function createOrUpdateCategoryPage(Request $request)
    {
        $data = [];
        if ('update' == $request->get('action')) {
            if ('product' == $request->get('type')) {
                $category_info = $this->categoryService->getProductCategory($request->get('category_id'));
            }

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
