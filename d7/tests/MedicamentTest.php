<?php

require __DIR__ . "/../src/medicament.php";

use Models\Medicament;
use PHPUnit\Framework\TestCase;

class MedicamentTest extends TestCase
{

    public function testMedicamentFind()
    {
        $this->assertTrue(Medicament::find(1, DBTest::getConnection()) instanceof Medicament);
    }
    public function testMedicamentGetAll()
    {
        $this->assertIsArray(Medicament::getAll(DBTest::getConnection()));
    }
    public function testMedicamentCreate()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Medicament::getAutoIncrement($pdo, 'medicament');
        $medicament = Medicament::create("None", "None", "None", $pdo);
        $medicament->save();
        $incAfter = Medicament::getAutoIncrement($pdo, 'medicament');
        $pdo->rollBack();

        $this->assertTrue($inc + 1 == $incAfter);
        $pdo->exec("ALTER TABLE `medicament` AUTO_INCREMENT=$inc;");
    }
    public function testMedicamentUpdate()
    {
        $pdo = DBTest::getConnection();
        $rValue = str_shuffle("abcdefghij");

        $pdo->beginTransaction();
        $inc = Medicament::getAutoIncrement($pdo, 'medicament');
        $medicament = Medicament::create("None", "None", "None", $pdo);
        $medicament->save();
        $medicament->setTitle($rValue);
        $medicament->save();
        $valueFromDB = Medicament::find($inc, $pdo)->getTitle();
        $pdo->rollBack();

        $this->assertEquals($rValue, $valueFromDB);
        $pdo->exec("ALTER TABLE `medicament` AUTO_INCREMENT=$inc;");
    }

    public function testMedicamentDelete()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Medicament::getAutoIncrement($pdo, 'medicament');
        $medicament = Medicament::create("None", "None", "None", $pdo);
        $medicament->save();
        $medicament->delete();
        $medicament->save();
        $pdo->rollBack();

        $this->assertNull($medicament::find($inc, $pdo));
        $pdo->exec("ALTER TABLE `medicament` AUTO_INCREMENT=$inc;");
    }
}
