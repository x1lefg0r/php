<?php
$sourceFile = 'test.txt';
$destinationDir = 'dir/';

if (!file_exists($sourceFile)) {
    die("Ошибка: Файл $sourceFile не найден в корне сайта!");
}

if (!file_exists($destinationDir)) {
    die("Ошибка: Папка $destinationDir не существует!");
}

$destinationFile = $destinationDir . 'test.txt';

if (copy($sourceFile, $destinationFile)) {
    echo "Файл успешно скопирован в $destinationFile";
} else {
    echo "Ошибка при копировании файла!";
}
?>