<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'rbac_role_users';

    protected $fillable = [
        'role_id', 'user_id',
    ];
}
