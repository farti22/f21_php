<?php

require __DIR__ . "/../src/medicamentRecipe.php";

use Models\medicamentRecipe;
use PHPUnit\Framework\TestCase;

class MedicamentRecipeTest extends TestCase
{
    public function testMedicamentRecipeGetAll()
    {
        $this->assertIsArray(\Models\MedicamentRecipe::getAll(DBTest::getConnection()));
    }
}
