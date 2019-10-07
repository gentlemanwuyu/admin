<?php
namespace App\Modules\Supplier\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {

    }

    public function getList()
    {
        return view('supplier::supplier.list');
    }
}
