<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'rbac_role_permissions';

    protected $fillable = [
        'role_id', 'permission_id', 'created_at',
    ];
}
