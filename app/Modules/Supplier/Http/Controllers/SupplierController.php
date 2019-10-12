<?php
namespace App\Modules\Supplier\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Supplier\Services\SupplierService;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function getList(Request $request)
    {
        $suppliers = $this->supplierService->getList($request);

        return view('supplier::supplier.list', compact('suppliers'));
    }
}
