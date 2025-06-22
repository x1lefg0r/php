<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['country'])) {
    $_SESSION['user_country'] = $_POST['country'];
    $message = "Страна сохранена: " . htmlspecialchars($_POST['country']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Выбор страны</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Укажите вашу страну</h1>
    
    <?php if (isset($message)): ?>
        <p style="color: green;"><?= $message ?></p>
        <p><a href="test.php">Перейти на test.php</a> чтобы увидеть сохраненную страну</p>
    <?php endif; ?>
    
    <form method="POST" action="">
        <select name="country" required>
            <option value="">-- Выберите страну --</option>
            <option value="Россия">Россия</option>
            <option value="Беларусь">Беларусь</option>
            <option value="Казахстан">Казахстан</option>
            <option value="Китай">Украина</option>
            <option value="Другая">Другая страна</option>
        </select>
        <button type="submit">Сохранить</button>
    </form>
</body>
</html>