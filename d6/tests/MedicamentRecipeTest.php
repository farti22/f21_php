<?php

require __DIR__ . "/../src/medicamentRecipe.php";

use PHPUnit\Framework\TestCase;

class MedicamentRecipeTest extends TestCase
{

    protected static $medicRecipe;

    public static function setUpBeforeClass(): void
    {
        self::$medicRecipe = new \Models\MedicamentRecipe(1, 1, DBTest::getConnection());
    }
    public function testMedicamentRecipeGetAll()
    {
        $this->assertIsArray(\Models\MedicamentRecipe::getAll(DBTest::getConnection()));
    }
}
