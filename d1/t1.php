<?php
// Realisation Stack Class

class Node
{
    public $data;
    public Node $ref;
}

class Stack
{
    private Node $head;

    public function __construct()
    {
        $this->length = 0;
        $this->head = new Node();
    }

    public function push($value)
    {
        $node = new Node();
        $node->data = $value;
        $node->ref = $this->head;
        $this->head = $node;
    }

    public function pop()
    {
        if ($this->isEmpty()) {
            throw new Exception("Stack empty");
        }
        $temp = &$this->head;
        $data = $temp->data;
        $this->head = $this->head->ref;
        unset($temp);
        return $data;
    }

    public function find($value)
    {
        $temp = $this->head;
        $index = 0;
        while (true) {
            if (!empty($temp->ref)) {
                if ($temp->data == $value) {
                    return $index;
                }
                $temp = $temp->ref;
            } else {
                return -1;
            }
            $index++;
        }
    }

    public function findByIndex($index)
    {
        if ($index < 0) {
            throw new Exception("Negative index");
        }
        $temp = $this->head;
        for ($_ = 0; $_ < $index; $_++) {
            if (!empty($temp->ref)) {
                $temp = $temp->ref;
            }
        }
        if (empty($temp->ref)) {
            throw new OutOfRangeException();
        }
        return $temp->data;
    }

    public function isEmpty()
    {
        return empty($this->head);
    }

    public function print()
    {
        $temp = $this->head;
        while (true) {
            if (!empty($temp->ref)) {
                echo $temp->data . " ";
                $temp = $temp->ref;
            } else {
                return;
            }
        }
    }
}

// Example

$stack = new Stack();
$stack->push(4);
$stack->push(8);
$stack->push(12);
$stack->push("t");

$stack->print();

echo "\n";
echo "find t: " . $stack->find("t") . "\n";
echo "find element by index 2: " . $stack->findByIndex(2) . "\n";
