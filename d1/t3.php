<?php
// Realisation Sort algoritms and Binary Search


// Additional function
// Swap two values
function swap(&$a, &$b)
{
    $temp = $a;
    $a = $b;
    $b = $temp;
}

function bubbleSort($arr)
{
    $count = count($arr);
    if ($count <= 1) return;
    for ($i = 0; $i < $count - 1; $i++) {
        for ($j = 0; $j < $count - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                swap($arr[$j], $arr[$j + 1]);
            }
        }
    }
    return $arr;
}

//Additonal function
// Merge two arrays
function merge(array $left, array $right)
{
    $res = array();
    while (count($left) > 0 && count($right) > 0) {
        if ($left[0] < $right[0]) {
            array_push($res, array_shift($left));
        } else {
            array_push($res, array_shift($right));
        }
    }

    array_splice($res, count($res), 0, $left);
    array_splice($res, count($res), 0, $right);

    return $res;
}

function mergeSort(&$arr)
{
    $count = count($arr);
    if ($count <= 1) {
        return $arr;
    }

    $left  = array_slice($arr, 0, intdiv($count, 2));
    $right = array_slice($arr, intdiv($count, 2));
    $left = mergeSort($left);
    $right = mergeSort($right);

    return merge($left, $right);
}

function quickSort(&$arr)
{
    $count = count($arr);
    if ($count <= 1) {
        return $arr;
    }

    $first = $arr[0];
    $left = array();
    $right = array();

    for ($i = 1; $i < $count; $i++) {
        if ($arr[$i] <= $first) {
            $left[] = $arr[$i];
        } else {
            $right[] = $arr[$i];
        }
    }
    $left = quickSort($left);
    $right = quickSort($right);

    return array_merge($left, [$first], $right);
}

function binarySearch($arr, $value, $startIndex = 0): int
{
    $count = count($arr);
    if ($count == 1) {
        if ($arr[0] == $value) {
            return $startIndex;
        }
        return -1;
    }
    $mid = intdiv($count, 2);
    if ($arr[$mid - 1] >= $value) {
        return binarySearch(array_slice($arr, 0, $mid), $value, $startIndex);
    } else {
        return binarySearch(array_slice($arr, $mid), $value, $mid + $startIndex);
    }
}

// Example
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14, 15, 16];
echo "Bubble Sort:\n";
shuffle($arr);
$arr = bubbleSort($arr);
print_r($arr);

echo "Merge Sort:\n";
shuffle($arr);
$arr = mergeSort($arr);
print_r($arr);

echo "Quick Sort:\n";
shuffle($arr);
$arr = quickSort($arr);
print_r($arr);
echo "BinarySearch(11): " . binarySearch($arr, 11);
