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
        $pdo->query("INSERT doctor(name) VALUES ('$name')");
        return new Doctor($pdo->lastInsertId(), $name, $pdo);
    }

    public static function find(int $index, \PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM doctor WHERE id=$index");
        foreach ($res as $row) {
            return new Doctor($row['id'], $row['name'], $pdo);
        }
    }

    public static function getFromPatientName(string $name, \PDO $pdo)
    {
        $res = $pdo->query(
            "SELECT doctor.id, doctor.name
            FROM doctor
              JOIN inspection ON doctor.id = inspection.doctorId
              JOIN patient ON inspection.patientId = patient.id
            WHERE patient.name LIKE '%$name%';"
        );

        $all = array();
        foreach ($res as $row) {
            $all[] = new Doctor(
                $row['id'],
                $row['name'],
                $pdo
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
