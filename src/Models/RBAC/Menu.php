<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;
use GepengPHP\LaravelRBAC\Models\RBAC\Role;
use GepengPHP\LaravelRBAC\Models\RBAC\Permission;
use GepengPHP\LaravelRBAC\Traits\ModelTree;

class Menu extends Model
{
    use ModelTree;

    protected $table = 'rbac_menu';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        $this->setParentColumn('parent_id');
        $this->setOrderColumn('order');
    }

    protected $fillable = [
        'parent_id', 'order', 'title', 'icon', 'uri', 'permission_slug',
    ];

    public function permission()
    {
        return $this->hasOne(Permission::class, 'slug', 'permission_slug');
    }

    public function permissible()
    {
        return $this->morphTo();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'rbac_role_menu', 'menu_id', 'role_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('order', 'ASC')->with('children');
    }

    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }
}
