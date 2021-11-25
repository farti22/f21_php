<?php

require __DIR__ . "/../src/medicament.php";

use PHPUnit\Framework\TestCase;

class MedicamentTest extends TestCase
{

    protected static $insp;

    public static function setUpBeforeClass(): void
    {
        self::$insp = new \Models\Medicament(1, "None", "None", "None", DBTest::getConnection());
    }
    public function testMedicamentFind()
    {
        $this->assertTrue(\Models\Medicament::find(1, DBTest::getConnection()) instanceof \Models\Medicament);
    }
    public function testMedicamentGetAll()
    {
        $this->assertIsArray(\Models\Medicament::getAll(DBTest::getConnection()));
    }
}
