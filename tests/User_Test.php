<?php

use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

include "config.php";

class UserTest extends TestCase
{
    use TestCaseTrait;

    public function getConnection()
    {
        $this->pdo = new PDO("mysql:host=localhost:8889;dbname=parcel_lab", "root", "1234");

        return $this->createDefaultDBConnection($this->pdo);
    }


    public function getDataSet()
    {
       return $this->createFlatXMLDataSet(__DIR__."/data/user.xml");
    }

    public function testSave()
    {
        $connection = new DBmysql();
        User::setDb($connection);
        $user1 = new User();
        $user1->setName("Michał");
        $user1->setSurname("Nowaczyk");
        $user1->setCredits(59);
        $user1->setAddress(1);
        $user1->save();
        $lastId = $connection->lastInsertId();
        $this->assertGreaterThan(0, $lastId);
        $this->assertNotNull(User::load($lastId));
        $this->assertNotNull(User::loadAll());
    }
}
// vendor/bin/phpunit tests/User_Test.php