<?php
// Recursive functions GCD / LCM / Fibonacci

function gcd(int $a, int $b): int
{
    return $b ? gcd($b, $a % $b) : $a;
}

function lcm(int $a, int $b): int
{
    return $a / gcd($a, $b) * $b;
}

function fib(int $v): int
{
    if ($v == 0 || $v == 1) return $v;
    return fib($v - 1) + fib($v - 2);
}






// Example

echo "GCD(54,45): " . gcd(54, 45) . "\n";
echo "LCM(24,16): " . lcm(24, 16) . "\n";
echo "Fibonacci(7): " . fib(7);
