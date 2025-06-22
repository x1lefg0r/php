<?php
session_start();

if (!isset($_SESSION['page_refresh_count'])) {
    $_SESSION['page_refresh_count'] = 0;
    $message = "Вы еще не обновляли эту страницу.";
} else {
    $_SESSION['page_refresh_count']++;
    $message = "Количество обновлений страницы: " . $_SESSION['page_refresh_count'];
}

echo "<h1>Счетчик обновлений</h1>";
echo "<p>$message</p>";
echo "<p><a href='".$_SERVER['PHP_SELF']."'>Обновить страницу</a></p>";

echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
echo '<input type="submit" name="reset" value="Сбросить счетчик">';
echo '</form>';

if (isset($_POST['reset'])) {
    $_SESSION['page_refresh_count'] = 0;
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>