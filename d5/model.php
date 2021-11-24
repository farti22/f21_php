<?php
require_once "inspection.php";

abstract class Model
{

    public array $changed;
    protected $class;
    protected PDO $pdo;
    protected $id;

    public function __construct($id, $pdo)
    {
        $this->id = $id;
        $this->pdo = $pdo;
        $this->changed = array();
    }

    protected function addChanged($v)
    {
        if (!in_array($v, $this->changed)) {
            $this->changed[] = $v;
        }
    }
    protected function clearChanged()
    {
        $this->changed = array();
    }
    public function save()
    {

        foreach ($this->changed as $name) {
            $getter = 'get' . ucfirst($name);
            echo $getter . "\n";
            $v = $this->$getter();
            print_r("UPDATE $this->class SET $name = '$v' WHERE id=$this->id");
            $this->pdo->query("UPDATE $this->class SET $name = '$v' WHERE id=$this->id");
        }
        $this->clearChanged();
    }
}
