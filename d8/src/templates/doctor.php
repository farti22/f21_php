<?php

use Models\Doctor;

echo "<table>";
echo "<tr>";
echo "<td>ID</td>";
echo "<td>Name</td>";
echo "</tr>";
$doctors = Doctor::getAll($pdo);

foreach ($doctors as $row) {
    $id = $row->getId();
    echo "<tr id=$id>";

    $name = $row->getName();
    echo "<td>$id</td>";
    echo "<td>$name</td>";
    echo "</tr>";
}

echo "</table>";
