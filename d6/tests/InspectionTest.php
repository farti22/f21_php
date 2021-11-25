<?php

require __DIR__ . "/../src/inspection.php";

use PHPUnit\Framework\TestCase;

class InspectionTest extends TestCase
{

    protected static $insp;

    public static function setUpBeforeClass(): void
    {
        self::$insp = new \Models\Inspection(1, 1, 1, "2021-11-11", "None", "None", "None", DBTest::getConnection());
    }
    public function testInspectionFind()
    {
        $this->assertTrue(\Models\Inspection::find(1, DBTest::getConnection()) instanceof \Models\Inspection);
    }
    public function testInspectionGetAll()
    {
        $this->assertIsArray(\Models\Inspection::getAll(DBTest::getConnection()));
    }
}
