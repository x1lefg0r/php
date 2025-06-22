<?php
session_start();

if (isset($_SESSION['message'])) {
    echo "Сообщение из сессии: " . $_SESSION['message'] . "<br>";
    echo "Время записи: " . $_SESSION['timestamp'];
} else {
    echo "В сессии нет данных. Сначала посетите <a href='page1.php'>первую страницу</a>.";
}
?>