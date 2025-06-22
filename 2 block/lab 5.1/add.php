<?php
function getAddForm() {
    $message = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=contacts_db;user=postgres;password=eg0rka6002006");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO contacts (last_name, first_name, middle_name, gender, birth_date, phone, address, email, comment) VALUES (:last_name, :first_name, :middle_name, :gender, :birth_date, :phone, :address, :email, :comment)");
        try {
            $stmt->execute([
                ':last_name' => $_POST['last_name'] ?? '',
                ':first_name' => $_POST['first_name'] ?? '',
                ':middle_name' => $_POST['middle_name'] ?? '',
                ':gender' => $_POST['gender'] ?? 'M',
                ':birth_date' => $_POST['birth_date'] ?? '2000-01-01',
                ':phone' => $_POST['phone'] ?? '',
                ':address' => $_POST['address'] ?? '',
                ':email' => $_POST['email'] ?? '',
                ':comment' => $_POST['comment'] ?? ''
            ]);
            $message = '<div class="message success">Запись добавлена</div>';
        } catch (PDOException $e) {
            $message = '<div class="message error">Ошибка: запись не добавлена</div>';
        }
    }

    $form = '<form method="POST">';
    $form .= '<label>Фамилия: <input type="text" name="last_name" required></label><br>';
    $form .= '<label>Имя: <input type="text" name="first_name" required></label><br>';
    $form .= '<label>Отчество: <input type="text" name="middle_name"></label><br>';
    $form .= '<label>Пол: <select name="gender" required><option value="" selected disabled>Выберите пол</option><option value="M">М</option><option value="F">Ж</option></select></label><br>';
    $form .= '<label>Дата рождения: <input type="date" name="birth_date" required></label><br>';
    $form .= '<label>Телефон: <input type="text" name="phone"></label><br>';
    $form .= '<label>Адрес: <input type="text" name="address"></label><br>';
    $form .= '<label>E-mail: <input type="email" name="email"></label><br>';
    $form .= '<label>Комментарий: <textarea name="comment"></textarea></label><br>';
    $form .= '<button type="submit">Добавить</button>';
    $form .= '</form>';
    $form .= $message;

    return $form;
}
?>