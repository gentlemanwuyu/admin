<?php
namespace App\Modules\Entrust\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Entrust\Services\RoleService;
use App\Modules\Entrust\Services\PermissionService;
use App\Modules\Entrust\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    protected $roleService;
    protected $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }
    
    public function getList(Request $request)
    {
        $roles = $this->roleService->getList($request);

        return view('entrust::role.list', compact('roles'));
    }

    public function createOrUpdatePage(Request $request)
    {
        $permissions = $this->permissionService->getAll();
        $data = compact('permissions');
        if ('update' == $request->get('action')) {
            $role_info = $this->roleService->getRole($request->get('role_id'));
            $data = array_merge($data, compact('role_info'));
        }

        return view('entrust::role.create_or_update_page', $data);
    }

    public function createOrUpdate(RoleRequest $request)
    {
        return response()->json($this->roleService->createOrUpdate($request));
    }

    public function delete(Request $request)
    {
        return response()->json($this->roleService->delete($request));
    }
}
