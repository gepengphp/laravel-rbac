<?php

namespace GepengPHP\LaravelRBAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use GepengPHP\LaravelRBAC\Http\Requests\RBAC\UserRequest;
use GepengPHP\LaravelRBAC\Models\RBAC\UserPermission;
use GepengPHP\LaravelRBAC\Models\RBAC\RoleUser;

class UserController extends Controller
{
    public function index(Request $request)
    {
        \DB::connection()->enableQueryLog();
        $pager = User::with('roles')->with('permissions')
            ->filter($request->filled('filter.keyword'), 'name', 'LIKE', "%{$request->input('filter.keyword')}%")
            ->filter($request->filled('filter.department_id'), 'department_id', $request->input('filter.department_id'))
            ->paginate($request->post('per_page', 10));
        return response()->RBACSuccess($pager->toArray());
    }

    public function info(int $id)
    {
        $user = User::with('department')->with('roles')->with('permissions')->findOrFail($id);
        return response()->RBACSuccess(\compact('user'));
    }

    public function store(UserRequest $request)
    {
        $user = new User($request->post());
        $user->password = bcrypt($request->password);
        DB::transaction(function () use ($user, $request) {
            $user->save();
            $user->permissions()->sync((array) $request->post('permission_ids'));
            $user->roles()->sync((array) $request->post('role_ids'));
        });
        $user->permissions;
        $user->roles;
        return response()->RBACSuccess(\compact('user'));
    }

    public function save(int $id, UserRequest $request)
    {
        $user = User::findOrFail($id);
        DB::transaction(function () use ($user, $request) {
            $data = $request->post();
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }
            $user->update($data);
            $user->permissions()->sync((array) $request->post('permission_ids'));
            $user->roles()->sync((array) $request->post('role_ids'));
        });
        $user->setRelation('permissions', $user->permissions);
        $user->setRelation('roles', $user->roles);
        return response()->RBACSuccess(\compact('user'));
    }

    public function destory(int $id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            DB::transaction(function () use ($user) {
                $user->delete();
                $user->permissions()->detach();
                $user->roles()->detach();
            });
        }
        return response()->RBACSuccess();
    }
}
