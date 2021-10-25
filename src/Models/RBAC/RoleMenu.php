<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $table = 'rbac_menu';

    protected $fillable = [
        'parent_id', 'order', 'title', 'icon', 'uri', 'permission',
    ];
}
