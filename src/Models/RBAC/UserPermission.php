<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table = 'rbac_user_permissions';

    protected $fillable = [
        'user_id', 'permission_id',
    ];
}
