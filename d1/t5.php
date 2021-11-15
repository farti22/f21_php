<?php
// Realisation Tree


class Node
{
    public $data;
    public Node $left;
    public Node $right;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

// Did't know which tree, so I made binary tree
class Tree
{
    private Node $root;

    public function add($value)
    {
        if (!empty($this->root)) {
            $this->addLeaf($value, $this->root);
        } else {
            $this->root = new Node($value);
        }
    }

    public function addLeaf($value, Node &$leaf)
    {
        if ($value < $leaf->data) {
            if (!empty($leaf->left)) {
                $this->addLeaf($value, $leaf->left);
            } else {
                $leaf->left = new Node($value);
            }
        } else {
            if (!empty($leaf->right)) {
                $this->addLeaf($value, $leaf->right);
            } else {
                $leaf->right = new Node($value);
            }
        }
    }

    public function print()
    {
        if (!empty($this->root)) {
            $this->printLeaf($this->root);
        }
    }

    public function printLeaf(Node $leaf)
    {
        if (!empty($leaf->right)) {
            $this->printLeaf($leaf->right);
        }

        print($leaf->data . " ");

        if (!empty($leaf->left)) {
            $this->printLeaf($leaf->left);
        }
    }
}

// Example
$tree = new Tree();
$tree->add(5);
$tree->add(8);
$tree->add(2);
$tree->add(1);
$tree->add(9);
$tree->print();
