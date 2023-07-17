<?php

namespace Ellite\Products\Models;

class TreeNode
{
    public $children;

    public function __construct(public $object)
    {
        $this->children = [];
    }

    public function createOrGetChild($object)
    {
        if (array_key_exists($object->id, $this->children)) {
            return $this->children[$object->id];
        }

        $child = new TreeNode($object);
        $this->addChild($child);
        return $child;
    }

    private function addChild(TreeNode $child)
    {
        $this->children[$child->object->id] = $child;
    }

    public function hasChildren()
    {
        return count($this->children) > 0;
    }

    public function findChildren(callable $func) : TreeNode|null
    {
        $search = array_filter(
            $this->children, $func
        );

        if (count($search)) {
            return array_values($search)[0];
        }

        return null;
    }
}
