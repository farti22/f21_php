<?php

namespace Models;

require_once "model.php";

class Recipe extends Model
{
    private int $inspectionId;

    public function __construct($id, $inspectionId, $pdo)
    {
        $this->name = $inspectionId;
        $this->class = "recipe";
        parent::__construct($id, $pdo);
    }

    public function setInspectionId(int $inspectionId)
    {
        $this->inspectionId = $inspectionId;
        $this->addChanged('inspectionId');
    }
    public function getInspectionId(): int
    {
        return $this->inspectionId;
    }

    public static function create($inspectionId, $pdo)
    {
        $pdo->query("INSERT patient(inspectionId) VALUES ('$inspectionId')");
        return new Recipe($pdo->lastInsertId(), $inspectionId, $pdo);
    }

    public static function find(int $index, \PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM recipe WHERE id=$index");
        foreach ($res as $row) {
            return new Recipe(
                $row['id'],
                $row['inspectionId'],
                $pdo
            );
        }
    }

    public static function getFromDoctorName(string $name, \PDO $pdo)
    {
        $res = $pdo->query(
            "SELECT recipe.id, recipe.inspectionId
            FROM recipe
              JOIN inspection ON recipe.inspectionId = inspection.id
              JOIN doctor ON inspection.doctorId = doctor.id
            WHERE doctor.name LIKE '%$name%';"
        );

        $all = array();
        foreach ($res as $row) {
            $all[] = new Recipe(
                $row['id'],
                $row['inspectionId'],
                $pdo
            );
        }
        return count($all) > 1 ? $all : $all[0];
    }

    public static function getAll(\PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM recipe");
        $all = array();
        foreach ($res as $row) {
            $arr[] = new Recipe(
                $row['id'],
                $row['inspectionId'],
                $pdo
            );
        }
        return $all;
    }
}
