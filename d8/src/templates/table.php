<?php

$CLASS = $_SERVER['QUERY_STRING'];


echo "<table>";

echo "<table>";
echo "<tr>";

$model = new $_SERVER['QUERY_STRING'];
var_dump($model);
foreach ($model as $rows) {
    if ($item_count == $max_per_row) {
        echo "</tr><tr>";
        $item_count = 0;
    }
    echo "<td><img src='" . $image . "' /></td>";
    $item_count++;
}
echo "</tr>";
echo "</table>";

echo "</table>";
