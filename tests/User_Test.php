<?php

use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

include 'movie.php';

class CinemaTest extends TestCase
{
    use TestCaseTrait;

    public function getConnection()
    {
        $this->pdo = new PDO("mysql:host=localhost:8889;dbname=movies_test", "root", "1234");

        return $this->createDefaultDBConnection($this->pdo);
    }


    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__."/data/movie.xml");
    }

    protected function setUp()
    {
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['submit'] = "addMovie";
    }
}