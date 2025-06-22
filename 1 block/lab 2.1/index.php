<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Задание для самостоятельной работы «Hello, World!»</title>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-circle">
                    <img src="./assets/medium_c79639673b5f9e5ef5cca1cfa6df72ab.png" alt="logo-image" class="logo">
                </div>
                <span class="logo-text">МосПолитех</span>
            </div>
            <h1>Задание для самостоятельной работы</h1>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="welcome-section">
                <h2>Hello, World!</h2>
                <p><?php 
                    $hour = date('H');
                    if ($hour < 12) {
                        echo 'Доброе утро';
                    } elseif ($hour < 18) {
                        echo 'Добрый день';
                    } else {
                        echo 'Добрый вечер';
                    }
                ?>! Добро пожаловать на страницу с динамическим контентом</p>
            </div>

            <div class="content-grid">
                <div class="card blue">
                    <h3>Текущее время</h3>
                    <p><?php echo date('l, d F Y'); ?><br>
                       <?php echo date('H:i:s'); ?></p>
                </div>

                <div class="card green">
                    <h3>Информация о сервере</h3>
                    <p>PHP версия: <?php echo phpversion(); ?></p>
                </div>

                <div class="card yellow">
                    <h3>Случайное число</h3>
                    <p>Случайное число: <strong><?php echo rand(1, 100); ?></strong></p>
                </div>

                <div class="card purple">
                    <h3>Информация о странице</h3>
                    <p>Страница создана с использованием<br>
                       динамического PHP контента</p>
                </div>
            </div>

            <div class="dynamic-greeting">
                <h3>Динамическое приветствие</h3>
                <p><?php 
                    $hour = date('H');
                    if ($hour < 12) {
                        echo 'Доброе утро';
                    } elseif ($hour < 18) {
                        echo 'Добрый день';
                    } else {
                        echo 'Добрый вечер';
                    }
                ?>, студент! Сегодня отличный день для изучения веб-разработки!</p>
            </div>
        </div>
    </main>

    <footer>
        <p>Задание для самостоятельной работы | МосПолитех © <?php echo date('Y'); ?></p>
    </footer>
</body>
</html>
