<?php

use Models\Patient;

echo "<table>";
echo "<tr>";
echo "<td>ID</td>";
echo "<td>Name</td>";
echo "<td>Gender</td>";
echo "<td>Birthday</td>";
echo "<td>Address</td>";
echo "</tr>";
$patients = Patient::getAll($pdo);

foreach ($patients as $row) {
    $id = $row->getId();
    echo "<tr id=$id>";
    $tds = array();
    $tds[] = $row->getId();
    $tds[] = $row->getName();
    $tds[] = $row->getGender();
    $tds[] = $row->getBirthday();
    $tds[] = $row->getAddress();

    foreach ($tds as $td) {
        echo "<td>$td</td>";
    }
    echo "</tr>";
}

echo "</table>";
