<?php

class Address implements Action
{
    /**
     * @var DBmysql $db
     */

    public static $db;

    private $id = -1;
    private $city = '';
    private $postcode = '';
    private $street = '';
    private $flatNumber = '';


    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setStreet(string $street)
    {
        $this->street = $street;

        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setFlatNumber(string $flatNumber)
    {
        $this->flatNumber = $flatNumber;

        return $this;
    }

    public function getFlatNumber(string $flatNumber)
    {
        $this->flatNumber = $flatNumber;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function loadAll()
    {
        $sql = "SELECT * FROM Address";
        self::$db->query($sql);
        $allFromDb = self::$db->resultSet();

        foreach ($allFromDb as $address) {
            // wypelniamy tablicę elementami z bazy
            $addressList[] = [
                'id' => $address['id'],
                'city' => $address['city'],
                'code' => $address['postcode'],
                'street' => $address['street'],
                'flat' => $address['flat_number']
            ];
        }
        return $addressList;
    }

    // te metody trzeba uzupełnić

    public function save()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }


    public static function load($id = null)
    {


    }


    public static function setDb(Database $db)
    {
        self::$db = $db;
    }
    
}