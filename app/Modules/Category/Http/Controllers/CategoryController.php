<?php
namespace App\Modules\Category\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {

	}

    public function productCategoryTree()
    {
        return view('category::category.product_category_tree');
    }
}
