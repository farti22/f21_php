<?php

require __DIR__ . "/../src/inspection.php";

use Models\Inspection;
use PHPUnit\Framework\TestCase;

class InspectionTest extends TestCase
{

    public function testInspectionFind()
    {
        $this->assertTrue(Inspection::find(1, DBTest::getConnection()) instanceof Inspection);
    }
    public function testInspectionGetAll()
    {
        $this->assertIsArray(Inspection::getAll(DBTest::getConnection()));
    }
    public function testInspectionCreate()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Inspection::getAutoIncrement($pdo, 'inspection');
        $isnpection = Inspection::create(1, 1, "2000-10-10", "None", "None", "None", $pdo);
        $isnpection->save();
        $incAfter = Inspection::getAutoIncrement($pdo, 'inspection');
        $pdo->rollBack();

        $this->assertTrue($inc + 1 == $incAfter);
        $pdo->exec("ALTER TABLE `inspection` AUTO_INCREMENT=$inc;");
    }
    public function testInspectionUpdate()
    {
        $pdo = DBTest::getConnection();
        $rValue = str_shuffle("abcdefghij");

        $pdo->beginTransaction();
        $inc = Inspection::getAutoIncrement($pdo, 'inspection');
        $isnpection = Inspection::create(1, 1, "2000-10-10", "None", "None", "None", $pdo);
        $isnpection->save();
        $isnpection->setComment($rValue);
        $isnpection->save();
        $valueFromDB = Inspection::find($inc, $pdo)->getComment();
        $pdo->rollBack();

        $this->assertEquals($rValue, $valueFromDB);
        $pdo->exec("ALTER TABLE `inspection` AUTO_INCREMENT=$inc;");
    }

    public function testInspectionDelete()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Inspection::getAutoIncrement($pdo, 'inspection');
        $isnpection = Inspection::create(1, 1, "2000-10-10", "None", "None", "None", $pdo);
        $isnpection->save();
        $isnpection->delete();
        $isnpection->save();
        $pdo->rollBack();

        $this->assertNull($isnpection::find($inc, $pdo));
        $pdo->exec("ALTER TABLE `inspection` AUTO_INCREMENT=$inc;");
    }
}
