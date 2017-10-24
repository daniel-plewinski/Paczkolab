<?php

Parcel::setDb($db);


if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Pobieramy (REST)

    $parcels = Parcel::loadAll();

    echo json_encode($parcels); // zwracamy json do frontendu - echo bo się nie da zwrócić

    exit();


} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Dodajemy (REST)

    // tworzymy objekt
    $parcel = new Parcel();

    // ustawiamy własności
    $parcel->setAddressId($_POST['address_id']);
    $parcel->setSizeId($_POST['size_id']);
    $parcel->setUserId($_POST['user_id']);

    // zapisujemy do bazy
    $parcel->save();

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patchVars);
    $parcelToUpdate = Parcel::load($patchVars['id']);
    $parcelToUpdate->setAddressId($patchVars['address_id']);
    $parcelToUpdate->setSizeId($patchVars['size_id']);
    $parcelToUpdate->setUserId($patchVars['user_id']);
    $parcelToUpdate->update();

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    parse_str(file_get_contents("php://input"), $deleteVars);
    $parcelToDelete = Parcel::load($deleteVars['id']); // zwraca pojedynczy objekt
    $parcelToDelete->delete();

}