<?php

use Models\Doctor;

$args = $_POST;
$action = array_pop($args);

print_r($args);
echo $action;

if ($action == "add") {
    $doctor = Doctor::create($args['name'], $pdo);
    $doctor->save();
    echo "Added";
} else if ($action == "edit") {
    $doctor = Doctor::find($args['id'], $pdo);
    $doctor->setName($args['name']);
    $doctor->save();  // from global
    echo "Edited";
} else if ($action == "delete") {
    $doctor = Doctor::find($args['id'], $pdo);
    $doctor->delete();
    $doctor->save();
    echo "Deleted";
}
