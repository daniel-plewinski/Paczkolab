<?php

class Size implements Action
{
    /**
     * @var DBmysql $db
     */

    public static $db;

    private $id = -1;
    private $name = '';
    private $price = 0;


    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function save()
    {
        if ($this->id > 0) {
            // UPDATE

        } else {
            // INSERT
            $sql = "INSERT INTO Size SET name=:name, price=:price";
            self::$db->query($sql);
            self::$db->bind('name', $this->getName());
            self::$db->bind('price', $this->getPrice());
            self::$db->execute();
        }
    }


    public function update()
    {
        $sql = "UPDATE Size SET name=:name, price=:price WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $this->id);
        self::$db->bind('name', $this->name);
        self::$db->bind('price', $this->price);
        self::$db->execute();
    }

    public function delete()
    {
        // DELETE
        $sql = "DELETE FROM Size WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $this->id);
        self::$db->execute();
    }

    public static function load($id = null)
    {

       // ta metoda ma stworzyć objekt Size i go zwrócić
        $sql = "SELECT * FROM Size WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $id);
        $singleSize = self::$db->single();

        $size = new Size();
        $size->setName($singleSize['name']);
        $size->setPrice($singleSize['price']);
        $size->id = $singleSize['id'];

        return $size; // Size to objekt Size
    }

    public static function loadAll()
    {
        $sql = "SELECT * FROM Size";
        self::$db->query($sql);
        $allFromDb = self::$db->resultSet();

        foreach ($allFromDb as $size) {
            // wypelniamy tablicę elementami z bazy
            $sizeList[] = [
                'id' => $size['id'],
                'size' => $size['name'],
                'price' => $size['price'],
            ];
        }
        return $sizeList;
    }

    public static function setDb(Database $db)
    {
        self::$db = $db;
    }
}