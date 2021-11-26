<?php

require __DIR__ . "/../src/doctor.php";

use Models\Doctor;
use PHPUnit\Framework\TestCase;


class DoctorTest extends TestCase
{
    public function testDoctorFind()
    {
        $this->assertTrue(Doctor::find(1, DBTest::getConnection()) instanceof Doctor);
    }
    public function testDoctorGetAll()
    {
        $this->assertIsArray(Doctor::getAll(DBTest::getConnection()));
    }
    public function testDoctorCreate()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Doctor::getAutoIncrement($pdo, 'doctor');
        $doctor = Doctor::create("None", $pdo);
        $doctor->save();
        $incAfter = Doctor::getAutoIncrement($pdo, 'doctor');
        $pdo->rollBack();

        $this->assertTrue($inc + 1 == $incAfter);
        $pdo->exec("ALTER TABLE `doctor` AUTO_INCREMENT=$inc;");
    }
    public function testDoctorUpdate()
    {
        $pdo = DBTest::getConnection();
        $rValue = str_shuffle("abcdefghij");

        $pdo->beginTransaction();
        $inc = Doctor::getAutoIncrement($pdo, 'doctor');
        $doctor = Doctor::create("None", $pdo);
        $doctor->save();
        $doctor->setName($rValue);
        $doctor->save();
        $valueFromDB = Doctor::find($inc, $pdo)->getName();
        $pdo->rollBack();

        $this->assertEquals($rValue, $valueFromDB);
        $pdo->exec("ALTER TABLE `doctor` AUTO_INCREMENT=$inc;");
    }

    public function testDoctorDelete()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Doctor::getAutoIncrement($pdo, 'doctor');
        $doctor = Doctor::create("None", $pdo);
        $doctor->save();
        $doctor->delete();
        $doctor->save();
        $pdo->rollBack();

        $this->assertNull($doctor::find($inc, $pdo));
        $pdo->exec("ALTER TABLE `doctor` AUTO_INCREMENT=$inc;");
    }
}
