<?php

namespace GepengPHP\LaravelRBAC\Traits;

trait ModelTree
{
    private $parentColumn = '';

    private $orderColumn = '';

    public function getParentColumn(): string
    {
        return $this->parentColumn;
    }

    public function setParentColumn(string $column): void
    {
        $this->parentColumn = $column;
    }

    public function getOrderColumn(): string
    {
        return $this->orderColumn;
    }

    public function setOrderColumn(string $column): void
    {
        $this->orderColumn = $column;
    }

    public static function seveOrder(array $tree, int $parentId = 0)
    {
        if (empty($tree)) {
            return;
        }

        foreach ($tree as $i => $branch) {
            $node = static::find($branch['id']);
            if (empty($node)) {
                continue;
            }

            $node->{$node->getParentColumn()} = $parentId;
            $node->{$node->getOrderColumn()} = $i + 1;
            $node->save();

            if (!empty($branch['children'])) {
                self::seveOrder($branch['children'], $branch['id']);
            }
        }
    }
}
