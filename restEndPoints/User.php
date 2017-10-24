<?php

User::setDb($db);


if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Pobieramy (REST)

    $users = User::loadAll();

    echo json_encode($users); // zwracamy json do frontendu - echo bo się nie da zwrócić

    exit();


    // kod poniżej trzeba uzupełnić bo dodałem tylko kopie z innego pliku

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Dodajemy (REST)

    // tworzymy objekt
    $user = new User();

    // ustawiamy własności
    $user->setName($_POST['name']);
    $user->setSurname($_POST['surname']);
    $user->setCredits($_POST['credits']);
    $user->setAddress($_POST['address_id']);

    // zapisujemy do bazy
    $user->save();

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patchVars);
    $userToUpdate = User::load($patchVars['id']);
    $userToUpdate->setName($patchVars['name']);
    $userToUpdate->setSurname($patchVars['surname']);
    $userToUpdate->setCredits($patchVars['credits']);
    $userToUpdate->update();



} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    parse_str(file_get_contents("php://input"), $deleteVars);
    $userToDelete = User::load($deleteVars['id']); // zwraca pojedynczy objekt
    $userToDelete->delete();

}