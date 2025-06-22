<?php
session_start();

$_SESSION['message'] = 'Привет из первой страницы!';
$_SESSION['timestamp'] = date('Y-m-d H:i:s');

echo "Данные записаны в сессию. Перейдите на <a href='page2.php'>вторую страницу</a>.";
?>