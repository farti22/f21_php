<?php

namespace Models;

require_once "model.php";

class Doctor extends Model
{
    private string $name;

    public function __construct(int $id, string $name, $pdo)
    {
        $this->name = $name;
        $this->class = "doctor";
        parent::__construct($id, $pdo);
    }

    public function setName(string $name)
    {
        $this->name = $name;
        $this->addChanged('name');
    }
    public function getName(): string
    {
        return $this->name;
    }

    public static function create(string $name, \PDO $pdo)
    {
        $doctor = new Doctor(self::getAutoIncrement($pdo, 'doctor'), $name, $pdo);
        $doctor->queries[] = "INSERT doctor(name) VALUES ('$name')";
        return $doctor;
    }

    public static function find(int $index, \PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM doctor WHERE id=$index");
        foreach ($res as $row) {
            return new Doctor($row['id'], $row['name'], $pdo);
        }
    }

    public function getRecipes()
    {
        $res = $this->pdo->query(
            "SELECT recipe.id, recipe.inspectionId
            FROM recipe
              JOIN inspection ON recipe.inspectionId = inspection.id
              JOIN doctor ON inspection.doctorId = doctor.id
            WHERE doctor.name LIKE '%$this->name%';"
        );

        $all = array();
        foreach ($res as $row) {
            $all[] = new Recipe(
                $row['id'],
                $row['inspectionId'],
                $this->pdo
            );
        }
        return count($all) > 1 ? $all : $all[0];
    }

    public static function getAll(\PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM doctor");
        $all = array();
        foreach ($res as $row) {
            $all[] = new Doctor($row['id'], $row['name'], $pdo);
        }
        return $all;
    }
}
