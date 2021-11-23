<?php

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

    public static function create($name, $gender, $birthday, $address, $pdo)
    {
        $pdo->query("INSERT patient(name, gender, birthday, address) VALUES ('$name', '$gender', '$birthday', '$address')");
        return new Patient($pdo->lastInsertId(), $name, $gender, $birthday, $address, $pdo);
    }
    public static function find(int $index, PDO $pdo)
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
    public static function getAll(PDO $pdo)
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
}
