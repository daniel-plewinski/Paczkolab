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

    // zapisujemy do bazy
    $parcel->save();

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patchVars);
    $parcelToUpdate = Parcel::load($patchVars['id']);

    $parcelToUpdate->update();



} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    parse_str(file_get_contents("php://input"), $deleteVars);
    $parcelToDelete = Parcel::load($deleteVars['id']); // zwraca pojedynczy objekt
    $parcelToDelete->delete();

}