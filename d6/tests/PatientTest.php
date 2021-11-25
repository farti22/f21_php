<?php

require __DIR__ . "/../src/patient.php";

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
}
