<?php

class Recipe extends Model
{
    private int $inspectionId;

    public function __construct($id, $inspectionId, $pdo)
    {
        $this->name = $inspectionId;
        $this->class = "recipe";
        parent::__construct($id, $pdo);
    }

    public static function create($inspectionId, $pdo)
    {
        $pdo->query("INSERT patient(inspectionId) VALUES ('$inspectionId')");
        return new Recipe($pdo->lastInsertId(), $inspectionId, $pdo);
    }
    public static function find(int $index, PDO $pdo)
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
    public static function getAll(PDO $pdo)
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
    public function setInspectionId(int $inspectionId)
    {
        $this->inspectionId = $inspectionId;
        $this->addChanged('inspectionId');
    }
    public function getInspectionId(): int
    {
        return $this->inspectionId;
    }
}
