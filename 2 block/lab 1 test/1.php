//1
<?php
$a = 27;
$b = 12;

$hypotenuse = sqrt($a ** 2 + $b ** 2);

$hypotenuse_rounded = round($hypotenuse, 2);

echo "Гипотенуза: " . $hypotenuse_rounded;

?>

//2 
<?php
$a = 27;
$b = 12; 

$leg = sqrt($a ** 2 - $b ** 2);

$leg_rounded = round($leg, 2);

echo "Другой катет: " . $leg_rounded;

?>

//3
<?php
$a = 27;
$b = 23;

$leg = sqrt($a ** 2 - $b ** 2);
$leg_rounded = round($leg, 2);

$alpha_rad = asin($b / $a);
$alpha_deg = rad2deg($alpha_rad);
$alpha_rounded = round($alpha_deg, 2);

$beta_deg = 90 - $alpha_deg;
$beta_rounded = round($beta_deg, 2);

echo "Второй катет: " . $leg_rounded . "\n";
echo "Угол напротив катета \$b = $b: " . $alpha_rounded . "°\n";
echo "Второй острый угол: " . $beta_rounded . "°\n";

?>

//30

<?php
$a = 3;
$b = '3';
$d = '3a';

echo "Нестрогое сравнение:\n";
var_dump($a == $b);
var_dump($a == $d);

echo "\nСтрогое сравнение:\n";
var_dump($a !== $d);
var_dump($a !== $b);
var_dump($b !== $d);
?>

//22

<?php
$a = 4;
$b = 3;
$c = ' мандаринок';

$result = $a * $b;
$result .= $c;

echo $result;
?>

//49

<?php
$f = 'string';
$length = strlen($f);
$sum = 0;

for ($i = 1; $i <= $length; $i++) {
    $sum += $i;
}

echo "Сумма первых $length натуральных чисел: $sum";
?>