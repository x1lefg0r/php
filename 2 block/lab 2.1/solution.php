//1
<?php
$array = ['a', 'b', 'c', 'b', 'a'];
$counts = array_count_values($array);

print_r($counts);
?>

//4
<?php
$keys = ['a', 'b', 'c'];
$values = [1, 2, 3];
$result = array_combine($keys, $values);

print_r($result);
?>

//9
<?php
$array = ['a' => 1, 'b' => 2, 'c' => 3];
$randomKey = array_rand($array);

echo "Случайный ключ: " . $randomKey;
?>

//16
<?php
$array = [1, 2, 3, 4, 5, 6, 7, 8];
$result = '';

while (!empty($array)) {
    $result .= array_shift($array);

    if (!empty($array)) {
        $result .= array_pop($array);
    }
}

echo $result;
?>

//36
<?php
$arr = ['a' => 1, 'b' => 2, 'c' => 3];
$sum = array_sum($arr);
echo "Сумма элементов: " . $sum;
?>

//49
<?php
function getDigitsSum($number) {
    $sum = 0;
    while ($number > 0) {
        $sum += $number % 10;
        $number = (int)($number / 10);
    }
    return $sum;
}

$resultYears = [];
for ($year = 1; $year <= 2022; $year++) {
    if (getDigitsSum($year) === 13) {
        $resultYears[] = $year;
    }
}

echo "Года от 1 до 2022, сумма цифр которых равна 13:\n";
print_r($resultYears);
?>