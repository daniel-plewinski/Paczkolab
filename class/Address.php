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

    public function setPostcode(string $postcode)
    {
        $this->postcode = $postcode;

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

    public function getFlatNumber(): string
    {
        return $this->flatNumber;
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

    public function save()
    {

        if ($this->id > 0) {
            // UPDATE

        } else {
            // INSERT
            $sql = "INSERT INTO Address SET city=:city, postcode=:code, street=:street, flat_number=:flat";
            self::$db->query($sql);
            self::$db->bind('city', $this->getCity());
            self::$db->bind('code', $this->getPostcode());
            self::$db->bind('street', $this->getStreet());
            self::$db->bind('flat', $this->getFlatNumber());
            self::$db->execute();
        }
    }

    public function update()
    {
        $sql = "UPDATE Address SET city=:city, postcode=:code, street=:street, flat_number=:flat WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $this->id);
        self::$db->bind('city', $this->city);
        self::$db->bind('code', $this->postcode);
        self::$db->bind('street', $this->street);
        self::$db->bind('flat', $this->flatNumber);
        self::$db->execute();
    }

    public function delete()
    {
        $sql = "DELETE FROM Address WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $this->id);
        self::$db->execute();
    }


    public static function load($id = null)
    {
        $sql = "SELECT * FROM Address WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $id);
        $singleAddress = self::$db->single();

        $address = new Address();
        $address->setCity($singleAddress['city']);
        $address->setPostcode($singleAddress['postcode']);
        $address->setStreet($singleAddress['street']);
        $address->setFlatNumber($singleAddress['flat_number']);
        $address->id = $singleAddress['id'];

        return $address;
    }


    public static function setDb(Database $db)
    {
        self::$db = $db;
    }
    
}