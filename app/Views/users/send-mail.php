<?php


require_once '../include/dbConnection.php';
require_once '../include/functions.php';


$data = [];
parse_str($_POST['formInputs'], $data);

// Validations
if(empty($data['marque'])) {
    $errors['marque'] = 'empty';
}
if(empty($data['model'])) {
    $errors['model'] = 'empty';
}
if(empty($data['annee'])) {
    $errors['annee'] = 'empty';
}
if(empty($data['couleur'])) {
    $errors['couleur'] = 'empty';
}

if(empty($errors)) {
    addMail($pdo, $data['marque'], $data['model'], $data['annee'], $data['couleur']);
    echo json_encode([
        'success' => true,
    ]);
} else {
    echo json_encode(['errors' => $errors]);
}
