<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'rbac_permissions';

    protected $fillable = [
        'name', 'slug', 'http_method', 'http_path',
    ];
}
