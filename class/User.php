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
    private $address = '';

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

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address)
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