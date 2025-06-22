<?php
$filesToDelete = ['1.txt', '2.txt', '3.txt'];

foreach ($filesToDelete as $filename) {
    if (file_exists($filename)) {
        if (unlink($filename)) {
            echo "Файл $filename успешно удален<br>";
        } else {
            echo "Ошибка при удалении файла $filename<br>";
        }
    } else {
        echo "Файл $filename не существует<br>";
    }
}
?>