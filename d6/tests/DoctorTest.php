<?php

require __DIR__ . "/../src/doctor.php";

use PHPUnit\Framework\TestCase;

class DoctorTest extends TestCase
{

    protected static $doctor;

    public static function setUpBeforeClass(): void
    {
        self::$doctor = new \Models\Doctor(1, "None", DBTest::getConnection());
    }
    public function testDoctorFind()
    {
        $this->assertTrue(\Models\Doctor::find(1, DBTest::getConnection()) instanceof \Models\Doctor);
    }
    public function testDoctorGetAll()
    {
        $this->assertIsArray(\Models\Doctor::getAll(DBTest::getConnection()));
    }
}
