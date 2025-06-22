<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Результат get_headers - МосПолитех</title>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-circle">
                    <img src="./assets/medium_c79639673b5f9e5ef5cca1cfa6df72ab.png" alt="logo" class="logo-image">
                </div>
                <span class="logo-text">МосПолитех</span>
            </div>
            <h1>Результат работы функции get_headers</h1>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="headers-section">
                <h2>HTTP заголовки с сайта httpbin.org</h2>
                <textarea readonly class="headers-output">
<?php
    $url = 'https://httpbin.org/get';
    $headers = get_headers($url, 1);
    
    if ($headers) {
        echo "URL: " . $url . "\n\n";
        echo "Заголовки:\n";
        echo str_repeat("=", 50) . "\n";
        
        foreach ($headers as $key => $value) {
            if (is_array($value)) {
                echo $key . ":\n";
                foreach ($value as $subValue) {
                    echo "  - " . $subValue . "\n";
                }
            } else {
                if (is_numeric($key)) {
                    echo $value . "\n";
                } else {
                    echo $key . ": " . $value . "\n";
                }
            }
        }
        
        echo "\n" . str_repeat("=", 50) . "\n";
        echo "Время получения: " . date('d.m.Y H:i:s');
    } else {
        echo "Ошибка при получении заголовков!";
    }
?>
                </textarea>
            </div>

            <div class="navigation">
                <a href="index.php" class="page-link">Вернуться к форме обратной связи</a>
            </div>
        </div>
    </main>

    <footer>
        <p>Задание для самостоятельной работы | МосПолитех <?php echo date('Y'); ?></p>
    </footer>
</body>
</html>