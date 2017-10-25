<?php

use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

include "config.php";

class ParcelTest extends TestCase
{
    use TestCaseTrait;

    public function getConnection()
    {
        $this->pdo = new PDO("mysql:host=localhost:8889;dbname=parcel_lab", "root", "1234");

        return $this->createDefaultDBConnection($this->pdo);
    }


    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__."/data/parcel.xml");
    }

    public function testSave()
    {
        $connection = new DBmysql();
        Parcel::setDb($connection);
        $parcel = new Parcel();
        $parcel->setAddressId(2);
        $parcel->setSizeId(3);
        $parcel->save();
        $lastId = $connection->lastInsertId();
        $this->assertGreaterThan(0, $lastId);
        $this->assertNotNull(Parcel::load($lastId));
        $this->assertNotNull(Parcel::loadAll());
    }
}
// vendor/bin/phpunit tests/ParcelTest.php