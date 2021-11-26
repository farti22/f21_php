<?php

require __DIR__ . "/../src/recipe.php";

use Models\Recipe;
use PHPUnit\Framework\TestCase;

class RecipeTest extends TestCase
{
    public function testRecipeFind()
    {
        $this->assertTrue(Recipe::find(1, DBTest::getConnection()) instanceof Recipe);
    }
    public function testRecipeGetAll()
    {
        $this->assertIsArray(Recipe::getAll(DBTest::getConnection()));
    }
    public function testRecipeCreate()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Recipe::getAutoIncrement($pdo, 'recipe');
        $recipe = Recipe::create(1, $pdo);
        $recipe->save();
        $incAfter = Recipe::getAutoIncrement($pdo, 'recipe');
        $pdo->rollBack();

        $this->assertTrue($inc + 1 == $incAfter);
        $pdo->exec("ALTER TABLE `recipe` AUTO_INCREMENT=$inc;");
    }
    public function testRecipeUpdate()
    {
        $pdo = DBTest::getConnection();
        $rValue = random_int(1, 50);

        $pdo->beginTransaction();
        $inc = Recipe::getAutoIncrement($pdo, 'recipe');
        $recipe = Recipe::create(1, $pdo);
        $recipe->save();
        $recipe->setInspectionId($rValue);
        $recipe->save();
        $valueFromDB = Recipe::find($inc, $pdo)->getInspectionId();
        $pdo->rollBack();

        $this->assertEquals($rValue, $valueFromDB);
        $pdo->exec("ALTER TABLE `recipe` AUTO_INCREMENT=$inc;");
    }

    public function testRecipeDelete()
    {
        $pdo = DBTest::getConnection();

        $pdo->beginTransaction();
        $inc = Recipe::getAutoIncrement($pdo, 'recipe');
        $recipe = Recipe::create(1, $pdo);
        $recipe->save();
        $recipe->delete();
        $recipe->save();
        $pdo->rollBack();

        $this->assertNull($recipe::find($inc, $pdo));
        $pdo->exec("ALTER TABLE `recipe` AUTO_INCREMENT=$inc;");
    }
}
