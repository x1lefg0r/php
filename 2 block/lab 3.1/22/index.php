<?php
$files = ['1.txt', '2.txt', '3.txt'];

foreach ($files as $filename) {
    if (file_put_contents($filename, '') !== false) {
        echo "Файл $filename успешно создан\n";
    } else {
        echo "Ошибка при создании файла $filename\n";
    }
}
?>