<?php
$filename = 'test.txt';

if (file_exists($filename) && is_file($filename)) {
    echo "Файл $filename существует и доступен.";
    
    echo "<br>Размер: " . filesize($filename) . " байт";
    echo "<br>Последнее изменение: " . date("Y-m-d H:i:s", filemtime($filename));
} else {
    echo "Файл $filename не существует или недоступен.";
}
?>