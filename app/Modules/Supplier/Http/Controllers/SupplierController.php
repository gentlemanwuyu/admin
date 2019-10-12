<?php
namespace App\Modules\Supplier\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Supplier\Services\SupplierService;
use App\Services\WorldService;
use App\Modules\Supplier\Http\Requests\SupplierRequest;
use App\Modules\Supplier\Repositories\SupplierRepository;

class SupplierController extends Controller
{
    protected $supplierService;
    protected $supplierRepository;

    public function __construct(SupplierService $supplierService, SupplierRepository $supplierRepository)
    {
        $this->supplierService = $supplierService;
        $this->supplierRepository = $supplierRepository;
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
        $data = compact('countries', 'chinese_regions');

        if ('update' == $request->get('action')) {
            $supplier_info = $this->supplierRepository->find($request->get('supplier_id'));
            $data = array_merge($data, compact('supplier_info'));
        }

        return view('supplier::supplier.create_or_update_supplier', $data);
    }

    public function createOrUpdateSupplier(SupplierRequest $request)
    {
        return response()->json($this->supplierService->createOrUpdateSupplier($request));
    }

    public function blackSupplier(Request $request)
    {
        return response()->json($this->supplierService->blackSupplier($request->get('supplier_id'), $request->get('reason')));
    }

    public function deleteSupplier(Request $request)
    {
        return response()->json($this->supplierService->deleteSupplier($request->get('supplier_id')));
    }
}
