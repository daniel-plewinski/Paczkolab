<?php

use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

include "config.php";

class SizeTest extends TestCase
{
    use TestCaseTrait;

    public function getConnection()
    {
        $this->pdo = new PDO("mysql:host=localhost:8889;dbname=parcel_lab", "root", "1234");

        return $this->createDefaultDBConnection($this->pdo);
    }


    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__."/data/size.xml");
    }

    public function testSave()
    {
        $connection = new DBmysql();
        Size::setDb($connection);
        $size = new Size();
        $size->setName("XXL");
        $size->setPrice(56.90);
        $size->save();
        $lastId = $connection->lastInsertId();
        $this->assertGreaterThan(0, $lastId);
        $this->assertNotNull(Size::load($lastId));
        $this->assertNotNull(Size::loadAll());
    }
}
// vendor/bin/phpunit tests/SizeTest.php