<?php

namespace Models;

abstract class Model
{

    public array $changed;
    public array $queries;
    protected $class;
    protected \PDO $pdo;
    protected $id;

    public function __construct($id, $pdo)
    {
        $this->id = $id;
        $this->pdo = $pdo;
        $this->changed = array();
        $this->queries = array();
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function addChanged($v)
    {
        if (!in_array($v, $this->changed)) {
            $this->changed[] = $v;
        }
    }
    public function clearChanged()
    {
        $this->changed = array();
    }

    public static function getAutoIncrement($pdo, $class): int
    {
        $res = $pdo->query("SELECT `AUTO_INCREMENT` AS last
        FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = 'medic' AND TABLE_NAME = '$class';");
        foreach ($res as $row) {
            echo $row['last'];
            return $row['last'];
        }
    }
    protected function execQueries()
    {
        while (!empty($this->queries)) {
            $value = array_shift($this->queries);
            echo $value . "<br>";
            $this->pdo->query($value);
        }
    }
    public function delete()
    {
        $this->queries[] = "DELETE FROM $this->class WHERE id=$this->id";
    }
    public function save()
    {
        $this->execQueries();
        foreach ($this->changed as $name) {
            $getter = 'get' . ucfirst($name);
            $v = $this->$getter();
            //print_r("UPDATE $this->class SET $name = '$v' WHERE id=$this->id");
            $this->pdo->query("UPDATE $this->class SET $name = '$v' WHERE id=$this->id");
        }
        $this->clearChanged();
    }
}
