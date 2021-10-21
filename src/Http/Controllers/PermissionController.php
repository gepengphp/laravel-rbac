<?php

namespace GepengPHP\LaravelRBAC\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GepengPHP\LaravelRBAC\Models\RBAC\Permission;
use GepengPHP\LaravelRBAC\Http\Requests\RABC\PermissionRequest;

class PermissionController extends Controller
{
    public function all()
    {
        $list = Permission::get()->toArray();
        return response()->success(\compact('list'));
    }

    public function index(Request $request)
    {
        $pager = Permission::paginate($request->post('per_page', 10));
        return response()->success($pager->toArray());
    }

    public function view(int $id)
    {
        $permission = Permission::findOrFail($id);
        return response()->success(\compact('permission'));
    }

    public function store(PermissionRequest $request)
    {
        $permission = new Permission($request->post());
        $permission->save();

        return response()->success(\compact('permission'));
    }

    public function save(int $id, PermissionRequest $request)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->post());
        return response()->success(\compact('permission'));
    }

    public function destory(int $id)
    {
        $permission = Permission::find($id);
        $permission && $permission->delete();
        return response()->success();
    }
}
