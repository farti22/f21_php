<?php

namespace Models;

require_once "model.php";

class Medicament extends Model
{
    private string $title;
    private string $description;
    private string $sideEffects;

    public function __construct($id, $title, $description, $sideEffects, $pdo)
    {
        $this->title = $title;
        $this->description = $description;
        $this->sideEffects = $sideEffects;
        $this->class = "medicament";
        parent::__construct($id, $pdo);
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        $this->addChanged('title');
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
        $this->addChanged('description');
    }
    public function setSideEffects(string $sideEffects)
    {
        $this->sideEffects = $sideEffects;
        $this->addChanged('sideEffects');
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getSideEffects(): string
    {
        return $this->sideEffects;
    }

    public static function create($title, $description, $sideEffects, $pdo)
    {
        $pdo->query("INSERT medicament(title, description, sideEffects) VALUES ('$title', '$description', '$sideEffects')");
        return new Medicament($pdo->lastInsertId(), $title, $description, $sideEffects, $pdo);
    }

    public static function find(int $index, \PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM medicament WHERE id=$index");
        foreach ($res as $row) {
            return new Medicament(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['sideEffects'],
                $pdo
            );
        }
    }

    public static function getFromPatientId(int $id, \PDO $pdo)
    {
        $res = $pdo->query(
            "SELECT medicament.id, medicament.title, medicament.description, medicament.sideEffects
        FROM medicament
          JOIN medicamentRecipe ON medicament.id = medicamentRecipe.medicamentId
          JOIN recipe ON medicamentRecipe.recipeId = recipe.id
          JOIN inspection ON recipe.inspectionId = inspection.id
        WHERE inspection.patientId = $id;"
        );

        $all = array();
        foreach ($res as $row) {
            $all[] = new Medicament(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['sideEffects'],
                $pdo
            );
        }
        if (empty($all)) return -1;
        return count($all) > 1 ? $all : $all[0];
    }

    public static function getFromInspectionId(int $id, \PDO $pdo)
    {
        $res = $pdo->query(
            "SELECT medicament.id, medicament.title, medicament.description, medicament.sideEffects
            FROM medicament
              JOIN medicamentRecipe ON medicament.id = medicamentRecipe.medicamentId
              JOIN recipe ON medicamentRecipe.recipeId = recipe.id
            WHERE recipe.inspectionId = $id;"
        );

        $all = array();
        foreach ($res as $row) {
            $all[] = new Medicament(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['sideEffects'],
                $pdo
            );
        }
        if (empty($all)) return -1;
        return count($all) > 1 ? $all : $all[0];
    }

    public static function getAll(\PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM medicament");
        $all = array();
        foreach ($res as $row) {
            $all[] = new Medicament(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['sideEffects'],
                $pdo
            );
        }
        return $all;
    }
}
