<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;
use GepengPHP\LaravelRBAC\Models\RBAC\Role;

class Permission extends Model
{
    protected $table = 'rbac_permissions';

    protected $fillable = [
        'name', 'slug', 'http_method', 'http_path',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'rbac_role_permissions', 'permission_id', 'role_id');
    }
}
