<?php
// Converter Decimal to Binary and vice verse
function decToBin(int $value): string
{
    $temp = "";

    while ($value != 0) {
        $temp .= $value % 2;
        $value = intdiv($value, 2);
    }

    return strrev($temp);
}

function binToDec(string $value): int
{
    $dec = 0;
    $len = strlen($value) - 1;

    for ($i = $len; $i >= 0; $i--) {
        $dec += (int)$value[$len - $i] * pow(2, $i);
    }

    return $dec;
}

// Example

echo decToBin(333) . " ";
echo binToDec("101001101");
