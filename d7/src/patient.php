<?php

namespace Models;

require_once "model.php";

class Patient extends Model
{
    private string $name;
    private string $gender;
    private string $birthday;
    private string $address;


    public function __construct($id, $name, $gender, $birthday, $address, $pdo)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->address = $address;
        $this->class = "patient";
        parent::__construct($id, $pdo);
    }

    public function setName(string $name)
    {
        $this->name = $name;
        $this->addChanged('name');
    }
    public function setGender(string $gender)
    {
        $this->gender = $gender;
        $this->addChanged('gender');
    }
    public function setBirthday(string $birthday)
    {
        $this->birthday = $birthday;
        $this->addChanged('birthday');
    }
    public function setAddress(string $address)
    {
        $this->address = $address;
        $this->addChanged('address');
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getGender(): string
    {
        return $this->gender;
    }
    public function getBirthday(): string
    {
        return $this->birthday;
    }
    public function getAddress(): string
    {
        return $this->address;
    }

    public static function create($name, $gender, $birthday, $address, $pdo)
    {
        $patient = new Patient(self::getAutoIncrement($pdo, 'patient'), $name, $gender, $birthday, $address, $pdo);
        $patient->queries[] = "INSERT patient(name, gender, birthday, address) VALUES ('$name', '$gender', '$birthday', '$address')";
        return $patient;
    }

    public static function find(int $index, \PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM patient WHERE id=$index");
        foreach ($res as $row) {
            return new Patient(
                $row['id'],
                $row['name'],
                $row['gender'],
                $row['birthday'],
                $row['address'],
                $pdo
            );
        }
    }

    public function getMedicaments()
    {
        $res = $this->pdo->query(
            "SELECT medicament.id, medicament.title, medicament.description, medicament.sideEffects
        FROM medicament
          JOIN medicamentRecipe ON medicament.id = medicamentRecipe.medicamentId
          JOIN recipe ON medicamentRecipe.recipeId = recipe.id
          JOIN inspection ON recipe.inspectionId = inspection.id
        WHERE inspection.patientId = $this->id;"
        );

        $all = array();
        foreach ($res as $row) {
            $all[] = new Medicament(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['sideEffects'],
                $this->pdo
            );
        }
        if (empty($all)) return -1;
        return count($all) > 1 ? $all : $all[0];
    }

    public function getDoctors()
    {
        $res = $this->pdo->query(
            "SELECT doctor.id, doctor.name
            FROM doctor
              JOIN inspection ON doctor.id = inspection.doctorId
              JOIN patient ON inspection.patientId = patient.id
            WHERE patient.name LIKE '%$this->name%';"
        );

        $all = array();
        foreach ($res as $row) {
            $all[] = new Doctor(
                $row['id'],
                $row['name'],
                $this->pdo
            );
        }
        return count($all) > 1 ? $all : $all[0];
    }

    public static function getAll(\PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM patient");
        $all = array();
        foreach ($res as $row) {
            $all[] = new Patient(
                $row['id'],
                $row['name'],
                $row['gender'],
                $row['birthday'],
                $row['address'],
                $pdo
            );
        }
        return $all;
    }
}
