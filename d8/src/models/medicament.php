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
        $medicament = new Medicament(self::getAutoIncrement($pdo, 'medicament'), $title, $description, $sideEffects, $pdo);
        $medicament->queries[] = "INSERT medicament(title, description, sideEffects) VALUES ('$title', '$description', '$sideEffects')";
        return $medicament;
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

    public function getPatients()
    {
        $res = $this->pdo->query(
            "SELECT patient.id, patient.name, patient.gender, patient.birthday, patient.address
        FROM patient
          JOIN inspection ON patient.id = inspection.patientId
          JOIN recipe ON inspection.id = recipe.inspectionId
          JOIN medicamentRecipe ON recipe.id = medicamentRecipe.recipeId
        WHERE medicamentRecipe.medicamentId = $this->id;"
        );

        $all = array();
        foreach ($res as $row) {
            $all[] = new Patient(
                $row['id'],
                $row['name'],
                $row['gender'],
                $row['birthday'],
                $row['address'],
                $this->pdo
            );
        }
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
