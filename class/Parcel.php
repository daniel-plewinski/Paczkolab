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
        if ($this->id > 0) {
            // UPDATE

        } else {
            // INSERT
            $sql = "INSERT INTO Parcel SET address_id=:addressid, user_id=:userid, size_id=:sizeid";
            self::$db->query($sql);
            self::$db->bind('addressid', $this->getAddressId());
            self::$db->bind('userid', $this->getUserId());
            self::$db->bind('sizeid', $this->getSizeId());
            self::$db->execute();
        }
    }

    public function update()
    {
        $sql = "UPDATE Parcel SET address_id=:addressid, user_id=:userid, size_id=:sizeid WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $this->id);
        self::$db->bind('addressid', $this->addressid);
        self::$db->bind('userid', $this->userid);
        self::$db->bind('sizeid', $this->sizeid);
        self::$db->execute();
    }

    public function delete()
    {
        $sql = "DELETE FROM Parcel WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $this->id);
        self::$db->execute();
    }

    public static function load($id = null)
    {
        $sql = "SELECT * FROM Parcel WHERE id=:id";
        self::$db->query($sql);
        self::$db->bind('id', $id);
        $singleParcel = self::$db->single();

        $parcel = new Parcel();
        $parcel->setAddressId($singleParcel['address_id']);
        $parcel->setUserId($singleParcel['user_id']);
        $parcel->setSizeId($singleParcel['size_id']);
        $parcel->id = $singleParcel['id'];

        return $parcel;

    }

    public static function setDb(Database $db)
    {
        self::$db = $db;
    }

}