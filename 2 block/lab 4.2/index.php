<?php
// Задача 1
$string1 = 'aaab';
$result1 = preg_replace('/(?<!a)a{3}(?=b)/', '!', $string1);
echo "1) " . $result1 . "\n";

// Задача 2
$string2 = 'aa aba abba abbba abbbba abbbbba';
preg_match_all('/ab{4,}a/', $string2, $matches2);
echo "2) ";
print_r($matches2[0]);

// Задача 3
$string3 = 'aba aca aea abba adca abea';
preg_match_all('/ab[be]a/', $string3, $matches3);
echo "3) ";
print_r($matches3[0]);

// Задача 4
$string4 = 'aae xxz 33a';
$result4 = preg_replace('/(.)\1/', '!', $string4);
echo "4) " . $result4 . "\n";
?>