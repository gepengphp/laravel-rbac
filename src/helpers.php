<?php

if (!function_exists('rbac_menu_create')) {
    function rbac_menu_create($tree, array $permissionSlugs)
    {
        $menu = [];
        if (empty($tree)) {
            return $menu;
        }

        foreach ($tree as $branch) {
            if (!in_array($branch['permission'], $permissionSlugs)) {
                continue;
            }

            $menu[] = [
                'id'        => $branch['id'],
                'parent_id' => $branch['parent_id'],
                'title'     => $branch['title'],
                'icon'      => $branch['icon'],
                'uri'       => $branch['uri'],
                'children'  => rbac_menu_create($branch['children'], $permissionSlugs),
            ];
        }

        return $menu;
    }
}