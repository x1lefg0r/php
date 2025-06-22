<?php
if (!isset($_COOKIE['test'])) {
    setcookie('test', '123', time() + 3600, '/');
    $message = "Кука 'test' установлена со значением '123'. Обновите страницу.";
} else {
    $message = "Значение куки 'test': " . htmlspecialchars($_COOKIE['test']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Тест куки</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Работа с куками</h1>
    <p><?= $message ?></p>
    
    <?php if (isset($_COOKIE['test'])): ?>
        <p><a href="cookie_test.php">Обновить страницу</a></p>
        <form method="post">
            <button type="submit" name="delete_cookie">Удалить куку</button>
        </form>
    <?php endif; ?>

    <?php
    if (isset($_POST['delete_cookie'])) {
        setcookie('test', '', time() - 3600, '/');
        header("Location: cookie_test.php");
        exit;
    }
    ?>
</body>
</html>