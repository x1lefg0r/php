<?php
$files = ['1.txt', '2.txt', '3.txt'];

foreach ($files as $filename) {
    if (file_exists($filename)) {
        $file = fopen($filename, 'a');
        fwrite($file, '!');
        fclose($file);
        echo "В файл {$filename} успешно добавлен '!'\n";
    } else {
        echo "Файл {$filename} не найден!\n";
    }
}
?>