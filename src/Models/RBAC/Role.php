<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;
use GepengPHP\LaravelRBAC\Models\RBAC\Permission;

class Role extends Model
{
    protected $table = 'rbac_roles';

    protected $fillable = [
        'name', 'slug',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'rbac_role_permissions', 'role_id', 'permission_id');
    }
}
