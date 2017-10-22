<?php

Address::setDb($db);


// do uzupełnienia
if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Pobieramy (REST)

    $addresses = Address::loadAll();

    echo json_encode($addresses); // zwracamy json do frontendu - echo bo się nie da zwrócić

    exit();


} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Dodajemy (REST)

    // tworzymy objekt
    $address = new Address();

    // ustawiamy własności
    $address->setCity($_POST['city']);
    $address->setPostcode($_POST['code']);
    $address->setStreet($_POST['street']);
    $address->setFlatNumber($_POST['flat']);

    // zapisujemy do bazy
    $address->save();

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patchVars);
    $addressToUpdate = Address::load($patchVars['id']);
    $addressToUpdate->setCity($patchVars['city']);
    $addressToUpdate->setPostcode($patchVars['code']);
    $addressToUpdate->setStreet($patchVars['street']);
    $addressToUpdate->setFlatNumber($patchVars['flat']);
    $addressToUpdate->update();



} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    parse_str(file_get_contents("php://input"), $deleteVars);
    $addressToDelete = Address::load($deleteVars['id']); // zwraca pojedynczy objekt
    $addressToDelete->delete();

}