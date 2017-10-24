<?php

class Parcel implements Action
{
    /**
     * @var DBmysql $db
     */

    public static $db;

    private $id = -1;
    private $address_id = '';
    private $user_id = '';
    private $size_id = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function getAddressId(): int
    {
        return $this->address_id;
    }

    public function setAddressId(int $addressid)
    {
        $this->address_id = $addressid;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $userid)
    {
        $this->user_id = $userid;

        return $this;
    }

    public function getSizeId(): int
    {
        return $this->size_id;
    }

    public function setSizeId(int $sizeid)
    {
        $this->size_id = $sizeid;

        return $this;
    }

    public static function loadAll()
    {
        $sql = "SELECT * FROM Parcel";
        self::$db->query($sql);
        $allFromDb = self::$db->resultSet();
        // var_dump($allFromDb); die;
        foreach ($allFromDb as $parcel) {
            // wypelniamy tablicę elementami z bazy
            $parcelList[] = [
                'id' => $parcel['id'],
                'address_id' => $parcel['address_id'],
                'user_id' => $parcel['user_id'],
                'size_id' => $parcel['size_id'],
            ];
        }
        return $parcelList;
    }

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