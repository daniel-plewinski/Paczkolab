<?php

Size::setDb($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Pobieramy (REST)

    $sizes = Size::loadAll();

    echo json_encode($sizes); // zwracamy json do frontendu - echo bo się nie da zwrócić

    exit();


} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Dodajemy (REST)

    // tworzymy objekt
    $size = new Size();

    // ustawiamy własności
    $size->setPrice($_POST['price']);
    $size->setName($_POST['size']);

    // zapisujemy do bazy
    $size->save();

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patchVars);
    $sizeToUpdate = Size::load($patchVars['id']);
    $sizeToUpdate->setPrice($patchVars['price']);
    $sizeToUpdate->setName($patchVars['size']);
    $sizeToUpdate->update();



} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    parse_str(file_get_contents("php://input"), $deleteVars);
    $sizeToDelete = Size::load($deleteVars['id']); // zwraca pojedynczy objekt Size
    $sizeToDelete->delete();

}