<?php
function calculateTrig($func, $param) {
    $rad = deg2rad($param);
    
    if (function_exists($func)) {
        return $func($rad);
    } else {
        throw new Exception("Тригонометрическая функция $func не поддерживается");
    }
}
?>