<?php

namespace GepengPHP\LaravelRBAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use GepengPHP\LaravelRBAC\Http\Requests\RBAC\RoleRequest;
use GepengPHP\LaravelRBAC\Models\RBAC\Role;
use GepengPHP\LaravelRBAC\Models\RBAC\RolePermission;
use Carbon\Carbon;

class RoleController extends Controller
{
    public function all(Request $request)
    {
        $list = Role::get()->toArray();
        return response()->RBACSuccess(\compact('list'));
    }

    public function index(Request $request)
    {
        $pager = Role::with('permissions')->paginate($request->post('per_page', 10));
        return response()->RBACSuccess($pager->toArray());
    }

    public function info(int $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return response()->RBACSuccess(\compact('role'));
    }

    public function store(RoleRequest $request)
    {
        $role = new Role($request->post());
        DB::transaction(function () use ($role, $request) {
            $role->save();
            $role->permissions()->sync((array) $request->post('permission_ids'));
        });
        $role->permissions;
        return response()->RBACSuccess(\compact('role'));
    }

    public function save(int $id, RoleRequest $request)
    {
        $role = Role::findOrFail($id);
        DB::transaction(function () use ($role, $request) {
            $role->update($request->post());
            $role->permissions()->sync((array) $request->post('permission_ids'));
            $role->permissions;
        });
        return response()->RBACSuccess(\compact('role'));
    }

    public function destory(int $id)
    {
        $role = Role::find($id);
        if (!empty($role)) {
            DB::transaction(function () use ($role) {
                $role->delete();
                $role->permissions()->detach();
            });
        }
        return response()->RBACSuccess();
    }
}
