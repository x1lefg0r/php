<?php
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expression = $_POST['expression'] ?? '';

    if (!isValidExpression($expression)) {
        echo "Ошибка: Недопустимое выражение";
        exit;
    }

    try {
        $result = calculateExpression($expression);
        echo $result;
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

function isValidExpression($expr) {
    if (!preg_match('/^[\d\+\-\*\/\(\)\.\s]+$/', $expr)) {
        return false;
    }

    $balance = 0;
    foreach (str_split($expr) as $char) {
        if ($char === '(') $balance++;
        if ($char === ')') $balance--;
        if ($balance < 0) return false;
    }
    return $balance === 0;
}

function calculateExpression($expr) {
    $expr = str_replace(' ', '', $expr);

    while (($start = strrpos($expr, '(')) !== false) {
        $end = strpos($expr, ')', $start);
        if ($end === false) throw new Exception("Несбалансированные скобки");
        
        $subExpr = substr($expr, $start + 1, $end - $start - 1);
        $subResult = calculateSubExpression($subExpr);
        $expr = substr_replace($expr, $subResult, $start, $end - $start + 1);
    }
    
    return calculateSubExpression($expr);
}

function calculateSubExpression($expr) {
    $expr = preg_replace_callback('/(\-?\d+\.?\d*)([\/\*])(\-?\d+\.?\d*)/', 
        function($matches) {
            return operate($matches[1], $matches[2], $matches[3]);
        }, 
        $expr
    );

    $expr = preg_replace_callback('/(\-?\d+\.?\d*)([\+\-])(\-?\d+\.?\d*)/', 
        function($matches) {
            return operate($matches[1], $matches[2], $matches[3]);
        }, 
        $expr
    );
    
    return $expr;
}

function operate($a, $operator, $b) {
    $a = floatval($a);
    $b = floatval($b);
    switch ($operator) {
        case '+': return $a + $b;
        case '-': return $a - $b;
        case '*': return $a * $b;
        case '/': 
            if ($b == 0) throw new Exception("Деление на ноль");
            return $a / $b;
        default: throw new Exception("Неизвестный оператор");
    }
}
?>