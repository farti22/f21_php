<?php

use PHPUnit\Framework\TestCase;

class DBTest extends TestCase
{
    public static function getConnection()
    {
        $host = 'localhost';
        $port = '3307';
        $db = 'medic';
        $user = 'root';
        $pass = '2121';

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
        return new PDO($dsn, $user, $pass);
    }
    public function testConnection()
    {
        $this->assertTrue(true);
        $this->getConnection();
    }
}
