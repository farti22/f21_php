<?php

use Models\Recipe;

echo "<table>";
echo "<tr>";
echo "<td>ID</td>";
echo "<td>Inspection ID</td>";
echo "</tr>";
$recipes = Recipe::getAll($pdo);

foreach ($recipes as $row) {
    $id = $row->getId();
    echo "<tr id=$id>";
    $tds = array();
    $tds[] = $row->getId();
    $tds[] = $row->getInspectionId();

    foreach ($tds as $td) {
        echo "<td>$td</td>";
    }
    echo "</tr>";
}

echo "</table>";
