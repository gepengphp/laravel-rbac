<?php

namespace GepengPHP\LaravelRBAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use GepengPHP\LaravelRBAC\Http\Requests\RBAC\MenuRequest;
use GepengPHP\LaravelRBAC\Models\RBAC\Menu;
use GepengPHP\LaravelRBAC\Models\RBAC\Role;
use GepengPHP\LaravelRBAC\Models\RBAC\Permission;

class MenuController extends Controller
{
    public function tree()
    {
        $tree = Menu::with('children')->where('parent_id', 0)->orderBy('order')->get();
        return response()->RBACSuccess(\compact('tree'));
    }

    public function reorder(Request $request)
    {
        Menu::seveOrder($request->post());
        return response()->RBACSuccess();
    }

    public function index(Request $request)
    {
        $pager = Menu::with('roles')->with('permission')->paginate($request->post('per_page', 10));
        return response()->RBACSuccess($pager->toArray());
    }

    public function info(int $id)
    {
        $menu = Menu::with('roles')->with('permission')->findOrFail($id);
        return response()->RBACSuccess(\compact('menu'));
    }

    public function store(MenuRequest $request)
    {
        $menu = new Menu($request->post());
        DB::transaction(function () use ($menu, $request) {
            $menu->save();
            $menu->roles()->sync((array) $request->post('role_ids'));
        });
        $menu->roles;
        $menu->setRelation('permission', Permission::where('slug', $menu->permission)->first());
        return response()->RBACSuccess(\compact('menu'));
    }
    
    public function save(int $id, MenuRequest $request)
    {
        $menu = Menu::findOrFail($id);
        DB::transaction(function () use ($menu, $request) {
            $menu->update($request->post());
            $menu->roles()->sync((array) $request->post('role_ids'));
        });
        $menu->roles;
        $menu->setRelation('permission', Permission::where('slug', $menu->permission)->first());
        return response()->RBACSuccess(\compact('menu'));
    }

    public function destory(int $id)
    {
        $menu = Menu::find($id);
        if (!empty($menu)) {
            DB::transaction(function () use ($menu) {
                $menu->delete();
                $menu->roles()->detach();
            });
        }
        return response()->RBACSuccess();
    }

    public function authMenu()
    {
        $tree = Menu::with('children')->where('parent_id', 0)->orderBy('order')->get();
        
        $user        = User::with('roles', 'permissions')->find(Auth::id());
        $roles       = Role::with('permissions')->whereIn('id', $user->roles()->pluck('id'))->get();
        $permissions = $roles->pluck('permissions')->flatten()->merge($user->permissions);

        $menu = \rbac_menu_create($tree->toArray(), $permissions->pluck('slug')->toArray());

        return response()->RBACSuccess(\compact('menu'));
    }
}
