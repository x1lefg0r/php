<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Форма обратной связи - МосПолитех</title>
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
            <h1>Форма обратной связи</h1>
        </div>
    </header>

    <main>
        <div class="container">
            <form action="https://httpbin.org/post" method="POST" class="feedback-form">
                <div class="form-group">
                    <label for="username">Имя пользователя:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail пользователя:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="appeal_type">Тип обращения:</label>
                    <select id="appeal_type" name="appeal_type" required>
                        <option value="" disabled selected>Выберите тип обращения</option>
                        <option value="complaint">Жалоба</option>
                        <option value="suggestion">Предложение</option>
                        <option value="gratitude">Благодарность</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Текст обращения:</label>
                    <textarea id="message" name="message" rows="6" required></textarea>
                </div>

                <div class="form-group">
                    <label>Вариант ответа:</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="sms" name="response_method[]" value="sms">
                            <label for="sms">SMS</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="email_response" name="response_method[]" value="email">
                            <label for="email_response">E-mail</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Отправить</button>
            </form>

            <div class="navigation">
                <a href="header.php" class="page-link">Перейти на страницу 2 (get_headers)</a>
            </div>
        </div>
    </main>

    <footer>
        <p>Задание для самостоятельной работы | МосПолитех <?php echo date('Y'); ?></p>
    </footer>
</body>
</html>
