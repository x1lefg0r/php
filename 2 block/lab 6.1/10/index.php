<?php
session_start();

if (!isset($_SESSION['birth_date'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['birth_date'])) {
        $birth_date = $_POST['birth_date'];
        if (preg_match("/^(\d{2})\.(\d{2})\.(\d{4})$/", $birth_date, $matches)) {
            $day = $matches[1];
            $month = $matches[2];
            $year = $matches[3];
            if (checkdate($month, $day, $year)) {
                $_SESSION['birth_date'] = $birth_date;
                $message = "Дата рождения сохранена! Перезайдите на сайт, чтобы узнать, сколько дней осталось до вашего дня рождения.";
            } else {
                $message = "Неверный формат даты! Введите дату в формате ДД.ММ.ГГГГ (например, 15.05.1990).";
            }
        } else {
            $message = "Неверный формат даты! Введите дату в формате ДД.ММ.ГГГГ (например, 15.05.1990).";
        }
    } else {
        $message = "Пожалуйста, введите вашу дату рождения в формате ДД.ММ.ГГГГ (например, 15.05.1990):";
    }
} else {
    $birth_date = $_SESSION['birth_date'];
    list($day, $month, $year) = explode('.', $birth_date);
    $birth_timestamp = mktime(0, 0, 0, $month, $day, date('Y'));
    $current_timestamp = time();
    $next_birthday = mktime(0, 0, 0, $month, $day, date('Y'));
    
    if ($current_timestamp > $next_birthday) {
        $next_birthday = mktime(0, 0, 0, $month, $day, date('Y') + 1);
    }
    
    $days_left = floor(($next_birthday - $current_timestamp) / (60 * 60 * 24));
    
    if ($days_left == 0) {
        $message = "Поздравляем с днем рождения!";
    } else {
        $message = "До вашего дня рождения осталось $days_left дней!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>День рождения</title>
</head>
<body>
    <h2><?php echo $message; ?></h2>
    <?php if (!isset($_SESSION['birth_date']) && !isset($_POST['birth_date'])): ?>
        <form method="post">
            <input type="text" name="birth_date" placeholder="ДД.ММ.ГГГГ" required>
            <input type="submit" value="Сохранить">
        </form>
    <?php endif; ?>
</body>
</html>