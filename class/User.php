<?php

class User implements Action
{
    /**
     * @var DBmysql $db
     */

    public static $db;

    private $id = -1;
    private $name = '';
    private $surname = '';
    private $credits = 0;
    private $address = 0;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    public function getCredits(): int
    {
        return $this->credits;
    }

    public function setCredits(int $credits)
    {
        $this->credits = $credits;

        return $this;
    }

    public function getAddress(): int
    {
        return $this->address;
    }

    public function setAddress(int $address)
    {
        $this->address = $address;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function loadAll()
    {
        $sql = "SELECT * FROM User";
        self::$db->query($sql);
        $allFromDb = self::$db->resultSet();

        foreach ($allFromDb as $user) {
            // wypelniamy tablicę elementami z bazy
            $userList[] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'surname' => $user['surname'],
                'credits' => $user['credits'],
                'address' => $user['address']
            ];
        }
        return $userList;
    }

    // te metody trzeba uzupełnić

    public function save()
    {
        if ($this->id > 0) {
            // UPDATE
            $this->update();

        } else {
            // INSERT
            $sql = "INSERT INTO User SET name=:name, surname=:surname, credits=:credits, address=:address";
            self::$db->query($sql);
            self::$db->bind('name', $this->getName());
            self::$db->bind('surname', $this->getSurname());
            self::$db->bind('credits', $this->getCredits());
            self::$db->bind('address', $this->getAddress());
            self::$db->execute();
        }
    }

    public function update()
    {
        $sql = "UPDATE User SET name=:name, surname=:surname, credits=:credits WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $this->id);
        self::$db->bind('name', $this->name);
        self::$db->bind('surname', $this->surname);
        self::$db->bind('credits', $this->credits);
        self::$db->execute();
    }

    public function delete()
    {
        $sql = "DELETE FROM User WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $this->id);
        self::$db->execute();
    }


    public static function load($id = null)
    {
        $sql = "SELECT * FROM User WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $id);
        $singleUser = self::$db->single();

        $user = new User();
        $user->setName($singleUser['name']);
        $user->setSurname($singleUser['surname']);
        $user->setCredits($singleUser['credits']);
        $user->setAddress($singleUser['address']);
        $user->id = $singleUser['id'];

        return $user;
    }


    public static function setDb(Database $db)
    {
        self::$db = $db;
    }


}