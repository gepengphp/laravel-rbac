<?php

namespace GepengPHP\LaravelRBAC\Auth;

class HasPermission
{
    private $tree;

    private $roles;

    private $permissionsSlug;

    public function __construct(array $tree)
    {
        $this->tree = $tree;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
        return $this;
    }

    public function setPermissions(array $permissions)
    {
        $this->permissionsSlug = array_column($permissions, 'slug');
        return $this;
    }

    function createMenu()
    {
        return $this->buildMenu($this->tree);
    }

    private function buildMenu(array $tree)
    {
        $menu = [];
        if (empty($tree)) {
            return $menu;
        }

        foreach ($tree as $branch) {
            if ($this->visible($branch['roles']) && $this->can($branch['permission_slug'])) {
                $children = $this->buildMenu($branch['children']);
                if (empty($branch['uri']) && empty($children)) {
                    continue;
                }
                $menu[] = [
                    'id'        => $branch['id'],
                    'parent_id' => $branch['parent_id'],
                    'title'     => $branch['title'],
                    'icon'      => $branch['icon'],
                    'uri'       => $branch['uri'],
                    'children'  => $children,
                ];
            }
        }

        return $menu;
    }

    private function can($permissionSlug): bool
    {
        if (empty($permissionSlug) || $this->isAdministrator()) {
            return true;
        }

        if (in_array($permissionSlug, $this->permissionsSlug)) {
            return true;
        }

        return \collect($this->roles)->pluck('permissions')->flatten(1)->pluck('slug')->contains($permissionSlug);
    }

    private function visible($roles): bool
    {
        // 未设置角色则全部可见
        if (empty($roles)) {
            return true;
        }

        $roles = array_column($roles, 'slug');

        return $this->isAdministrator() || !empty(array_intersect($roles, array_column($this->roles, 'slug')));
    }

    function isAdministrator(): bool
    {
        return in_array(config('laravel-rbac.default_role_name'), array_column($this->roles, 'slug'));
    }
}
