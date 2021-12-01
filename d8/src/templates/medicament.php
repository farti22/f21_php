<?php

use Models\Medicament;

echo "<table>";
echo "<tr>";
echo "<td>ID</td>";
echo "<td>Title</td>";
echo "<td>Side effects</td>";
echo "</tr>";
$medicaments = Medicament::getAll($pdo);

foreach ($medicaments as $row) {
    $id = $row->getId();
    echo "<tr id=$id>";
    $tds = array();
    $tds[] = $row->getId();
    $tds[] = $row->getTitle();
    $tds[] = $row->getSideEffects();

    foreach ($tds as $td) {
        echo "<td>$td</td>";
    }
    echo "</tr>";
}

echo "</table>";
