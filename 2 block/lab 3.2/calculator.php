<?php
require_once 'trigonometry.php';

$expression = file_get_contents('Task/expression.txt');
if ($expression === false) {
    die("Не удалось прочитать файл с выражением");
}

preg_match('/(\w+)\((\d+)\)\*(\w+)\((\d+)\)/', $expression, $matches);

if (count($matches) === 5) {
    $func1 = $matches[1];
    $param1 = $matches[2];
    $func2 = $matches[3];
    $param2 = $matches[4];
    
    try {
        $val1 = calculateTrig($func1, $param1);
        $val2 = calculateTrig($func2, $param2);
        
        $result = $val1 * $val2;
        
        echo "Результат выражения $expression: " . round($result, 4);
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
} else {
    echo "Неверный формат тригонометрического выражения";
}
?>