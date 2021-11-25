<?php

namespace Models;

require_once "model.php";

class Inspection extends Model
{
    private int $patientId;
    private int $doctorId;
    private string $date;
    private string $symptoms;
    private string $diagnosis;
    private string $comment;

    public function __construct(int $id, $patientId, $doctorId, $date, $symptoms, $diagnosis, $comment, $pdo)
    {
        $this->patientId = $patientId;
        $this->doctorId = $doctorId;
        $this->date = $date;
        $this->symptoms = $symptoms;
        $this->diagnosis = $diagnosis;
        $this->comment = $comment;
        $this->class = "inspection";
        parent::__construct($id, $pdo);
    }

    public function setPatientId(int $patientId)
    {
        $this->patientId = $patientId;
        $this->addChanged('patientId');
    }
    public function setDoctorId(int $doctorId)
    {
        $this->doctorId = $doctorId;
        $this->addChanged('doctorId');
    }
    public function setDate(string $date)
    {
        $this->date = $date;
        $this->addChanged('date');
    }
    public function setSymptoms(string $symptoms)
    {
        $this->symptoms = $symptoms;
        $this->addChanged('symptoms');
    }
    public function setDiagnosis(string $diagnosis)
    {
        $this->diagnosis = $diagnosis;
        $this->addChanged('diagnosis');
    }
    public function setComment(string $comment)
    {
        $this->comment = $comment;
        $this->addChanged('comment');
    }
    public function getPatientId(): int
    {
        return $this->patientId;
    }
    public function getDoctorId(): int
    {
        return $this->doctorId;
    }
    public function getDate(): string
    {
        return $this->date;
    }
    public function getSymptoms(): string
    {
        return $this->symptoms;
    }
    public function getDiagnosis(): string
    {
        return $this->diagnosis;
    }
    public function getComment(): string
    {
        return $this->comment;
    }

    public static function create($patientId, $doctorId, $date, $symptoms, $diagnosis, $comment, $pdo)
    {
        $pdo->query("INSERT inspection(patientId, doctorId, date, symptoms, diagnosis, comment)
                    VALUES ('$patientId', '$doctorId', '$date', '$symptoms', '$diagnosis', '$comment')");
        return new Inspection($pdo->lastInsertId(), $patientId, $doctorId, $date, $symptoms, $diagnosis, $comment, $pdo);
    }

    public static function find(int $index, \PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM inspection WHERE id=$index");
        foreach ($res as $row) {
            return new Inspection(
                $row['id'],
                $row['patientId'],
                $row['doctorId'],
                $row['date'],
                $row['symptoms'],
                $row['diagnosis'],
                $row['comment'],
                $pdo
            );
        }
    }

    public static function getAll(\PDO $pdo)
    {
        $res = $pdo->query("SELECT * FROM inspection");
        $all = array();
        foreach ($res as $row) {
            $all[] = new Inspection(
                $row['id'],
                $row['patientId'],
                $row['doctorId'],
                $row['date'],
                $row['symptoms'],
                $row['diagnosis'],
                $row['comment'],
                $pdo
            );
        }
        return $all;
    }
}
