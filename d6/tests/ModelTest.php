<?php

use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    public function testChanged()
    {
        $model = $this->getMockForAbstractClass(\Models\Model::class, [0, DBTest::getConnection()]);
        $model->addChanged("test");
        $this->assertNotEmpty($model->changed);
        $model->clearChanged();
        $this->assertEmpty($model->changed);
    }
}
