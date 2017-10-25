<?php

use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

include "config.php";

class AddressTest extends TestCase
{
    use TestCaseTrait;

    public function getConnection()
    {
        $this->pdo = new PDO("mysql:host=localhost:8889;dbname=parcel_lab", "root", "1234");

        return $this->createDefaultDBConnection($this->pdo);
    }


    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__."/data/address.xml");
    }

    public function testSave()
    {
        $connection = new DBmysql();
        Address::setDb($connection);
        $address1 = new Address();
        $address1->setCity("London");
        $address1->setStreet("High Street");
        $address1->setFlatNumber(9);
        $address1->setPostcode("L78 GFS");
        $address1->save();
        $lastId = $connection->lastInsertId();
        $this->assertGreaterThan(0, $lastId);
        $this->assertNotNull(Address::load($lastId));
        $this->assertNotNull(Address::loadAll());
    }
}
// vendor/bin/phpunit tests/AddressTest.php