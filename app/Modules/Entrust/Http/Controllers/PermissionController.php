<?php
namespace App\Modules\Entrust\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Entrust\Services\PermissionService;
use App\Modules\Entrust\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function getList(Request $request)
    {
        $permissions = $this->permissionService->getList($request);

        return view('entrust::permission.list', compact('permissions'));
	}

    public function createOrUpdatePage(Request $request)
    {
        $permission_types = $this->permissionService->getPermissionTypes();

        $data = compact('permission_types');

        if ('update' == $request->get('action')) {
            $permission_info = $this->permissionService->getPermission($request->get('permission_id'));
            $data = array_merge($data, compact('permission_info'));
        }

        return view('entrust::permission.create_or_update_page', $data);
    }

    public function createOrUpdate(PermissionRequest $request)
    {
        return response()->json($this->permissionService->createOrUpdate($request));
    }

    public function delete(Request $request)
    {
        return response()->json($this->permissionService->delete($request));
    }
}
