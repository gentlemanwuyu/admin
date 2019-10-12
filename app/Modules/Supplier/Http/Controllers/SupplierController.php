<?php
namespace App\Modules\Supplier\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Supplier\Services\SupplierService;
use App\Services\WorldService;
use App\Modules\Supplier\Http\Requests\SupplierRequest;

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

    public function createOrUpdateSupplierPage(Request $request)
    {
        $countries = WorldService::countries();
        $chinese_regions = WorldService::chineseTree();

        return view('supplier::supplier.create_or_update_supplier', compact('countries', 'chinese_regions'));
    }

    public function createOrUpdateSupplier(SupplierRequest $request)
    {
        return response()->json($this->supplierService->createOrUpdateSupplier($request));
    }
}
