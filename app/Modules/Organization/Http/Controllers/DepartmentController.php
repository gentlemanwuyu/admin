<?php
namespace App\Modules\Organization\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Organization\Services\DepartmentService;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function chart(Request $request)
    {
        return view('organization::department.chart');
    }

    public function getTree()
    {
        return response()->json($this->departmentService->getTree());
    }

    public function add(Request $request)
    {
        return response()->json($this->departmentService->add($request));
    }

    public function update(Request $request)
    {
        return response()->json($this->departmentService->update($request));
    }

    public function delete(Request $request)
    {
        return response()->json($this->departmentService->delete($request->get('department_id')));
    }

    public function drag(Request $request)
    {
        return response()->json($this->departmentService->drag($request));
    }
}
