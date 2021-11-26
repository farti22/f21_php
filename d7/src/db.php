<?php
require_once "require.php";

$host = 'localhost';
$port = '3307';
$db = 'medic';
$user = 'root';
$pass = '2121';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
$pdo = new PDO($dsn, $user, $pass);

echo "connected to DB \n";

$doctors = \Models\Doctor::getAll($pdo);
foreach ($doctors as $doc) {
    echo $doc->getName() . "\n";
}


$doctor = \Models\Doctor::create("Test", $pdo);
$doctor->delete();
$doctor->save();
// $insp = \Models\Inspection::find(3, $pdo);

// $insp->setDiagnosis("Exactly badly!");
// $insp->setComment("No comment");
// $insp->save();

// work
//$med = \Models\Medicament::getFromPatientId(2, $pdo);
// $doc = \models\Doctor::getFromPatientName("Былинский", $pdo);
// print_r($doc);

// work
//$patient = Patient::create("Pavel", "Male", "2000-10-10", "Minsk city, Rafieva Street 80, 324", $pdo);
//$patient->setName("Zaev Pavel");
//$patient->save();
// work
//$newInsp = Inspection::create(1, 5, '2021-11-22', 'Shaking hands, headache, faint', "Unknown", "No comments", $pdo);
