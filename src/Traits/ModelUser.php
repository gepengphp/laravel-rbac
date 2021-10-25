<?php

namespace GepengPHP\LaravelRBAC\Traits;

use GepengPHP\LaravelRBAC\Models\RBAC\Permission;
use GepengPHP\LaravelRBAC\Models\RBAC\Role;

trait ModelUser
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'rbac_user_permissions', 'user_id', 'permission_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'rbac_role_users', 'user_id', 'role_id');
    }

    public function can($ability, $arguments = [])
    {
        if (empty($ability)) {
            return true;
        }

        if ($this->permissions->pluck('slug')->contains($ability)) {
            return true;
        }

        return $this->roles->pluck('permissions')->flatten()->pluck('slug')->contains($ability);
    }

    public function cannot($permission, $arguments = [])
    {
        return !$this->can($permission);
    }
}
