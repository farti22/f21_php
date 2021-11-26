<?php

require __DIR__ . "/../src/patient.php";

use Models\Patient;
use PHPUnit\Framework\TestCase;

class PatientTest extends TestCase
{

    protected static $doctor;

    public static function setUpBeforeClass(): void
    {
        self::$doctor = new \Models\Patient(1, "None", "None", "None", "None", DBTest::getConnection());
    }
    public function testPatientFind()
    {
        $this->assertTrue(\Models\Patient::find(1, DBTest::getConnection()) instanceof \Models\Patient);
    }
    public function testPatientGetAll()
    {
        $this->assertIsArray(\Models\Patient::getAll(DBTest::getConnection()));
    }
    public function testPatientCreate()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Patient::getAutoIncrement($pdo, 'patient');
        $patient = Patient::create("None", "None", "2000-10-10", "None", $pdo);
        $patient->save();
        $incAfter = Patient::getAutoIncrement($pdo, 'patient');
        $pdo->rollBack();

        $this->assertTrue($inc + 1 == $incAfter);
        $pdo->exec("ALTER TABLE `patient` AUTO_INCREMENT=$inc;");
    }
    public function testPatientUpdate()
    {
        $pdo = DBTest::getConnection();
        $rValue = str_shuffle("abcdefghij");

        $pdo->beginTransaction();
        $inc = Patient::getAutoIncrement($pdo, 'patient');
        $patient = Patient::create("None", "None", "2000-10-10", "None", $pdo);
        $patient->save();
        $patient->setName($rValue);
        $patient->save();
        $valueFromDB = Patient::find($inc, $pdo)->getName();
        $pdo->rollBack();

        $this->assertEquals($rValue, $valueFromDB);
        $pdo->exec("ALTER TABLE `patient` AUTO_INCREMENT=$inc;");
    }

    public function testPatientDelete()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Patient::getAutoIncrement($pdo, 'patient');
        $patient = Patient::create("None", "None", "2000-10-10", "None", $pdo);
        $patient->save();
        $patient->delete();
        $patient->save();
        $pdo->rollBack();

        $this->assertNull($patient::find($inc, $pdo));
        $pdo->exec("ALTER TABLE `patient` AUTO_INCREMENT=$inc;");
    }
}
