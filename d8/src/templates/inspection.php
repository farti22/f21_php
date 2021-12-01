<?php

use Models\Inspection;

echo "<table>";

echo "<tr>";
echo "<td>ID</td>";
echo "<td>Patient ID</td>";
echo "<td>Doctor ID</td>";
echo "<td>Date</td>";
echo "<td>Symptoms</td>";
echo "<td>Diagnosis</td>";
echo "<td>Comment</td>";
echo "</tr>";
$inspections = Inspection::getAll($pdo);

foreach ($inspections as $row) {
    $id = $row->getId();
    echo "<tr id=$id>";
    $tds = array();
    $tds[] = $row->getId();
    $tds[] = $row->getPatientId();
    $tds[] = $row->getDoctorId();
    $tds[] = $row->getDate();
    $tds[] = $row->getSymptoms();
    $tds[] = $row->getDiagnosis();
    $tds[] = $row->getComment();

    foreach ($tds as $td) {
        echo "<td>$td</td>";
    }
    echo "</tr>";
}

echo "</table>";
