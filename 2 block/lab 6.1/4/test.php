<?php
session_start();

if (isset($_SESSION['user_country'])) {
    $country = htmlspecialchars($_SESSION['user_country']);
    $message = "Ваша страна: $country";
} else {
    $message = "Вы еще не выбрали страну.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ваша страна</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Информация о стране</h1>
    <p><?= $message ?></p>
    <p><a href="index.php">Вернуться на index.php</a> чтобы изменить страну</p>
</body>
</html>