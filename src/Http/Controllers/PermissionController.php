<?php

namespace GepengPHP\LaravelRBAC\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GepengPHP\LaravelRBAC\Models\RBAC\Permission;
use GepengPHP\LaravelRBAC\Http\Requests\RBAC\PermissionRequest;
use DB;

class PermissionController extends Controller
{
    public function all()
    {
        $list = Permission::get()->toArray();
        return response()->RBACSuccess(\compact('list'));
    }

    public function index(Request $request)
    {
        $pager = Permission::filter($request->filled('filter.keyword'), 'keyword', 'LIKE', "%{$request->input('filter.keyword')}%")
            ->paginate($request->post('per_page', 10));
        return response()->RBACSuccess($pager->toArray());
    }

    public function info(int $id)
    {
        $permission = Permission::findOrFail($id);
        return response()->RBACSuccess(\compact('permission'));
    }

    public function store(PermissionRequest $request)
    {
        $permission = new Permission($request->post());
        $permission->save();
        return response()->RBACSuccess(\compact('permission'));
    }

    public function save(int $id, PermissionRequest $request)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->post());
        return response()->RBACSuccess(\compact('permission'));
    }

    public function destory(int $id)
    {
        $permission = Permission::find($id);
        $permission && $permission->delete();
        return response()->RBACSuccess();
    }
}
