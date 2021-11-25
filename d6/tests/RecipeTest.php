<?php

require __DIR__ . "/../src/recipe.php";

use PHPUnit\Framework\TestCase;

class RecipeTest extends TestCase
{

    protected static $doctor;

    public static function setUpBeforeClass(): void
    {
        self::$doctor = new \Models\Recipe(1, 1, DBTest::getConnection());
    }
    public function testRecipeFind()
    {
        $this->assertTrue(\Models\Recipe::find(1, DBTest::getConnection()) instanceof \Models\Recipe);
    }
    public function testRecipeGetAll()
    {
        $this->assertIsArray(\Models\Recipe::getAll(DBTest::getConnection()));
    }
}
