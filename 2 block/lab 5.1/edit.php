<?php
function getEditForm() {
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=contacts_db;user=postgres;password=eg0rka6002006");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'] ?? null;
    $contact = null;
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump("ID: $id, Contact: ", $contact);
    }

    $message = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id && $contact) {
        try {
            $stmt = $pdo->prepare("UPDATE contacts SET last_name = :last_name, first_name = :first_name, middle_name = :middle_name, gender = :gender, birth_date = :birth_date, phone = :phone, address = :address, email = :email, comment = :comment WHERE id = :id");
            $stmt->execute([
                ':last_name' => $_POST['last_name'],
                ':first_name' => $_POST['first_name'],
                ':middle_name' => $_POST['middle_name'],
                ':gender' => $_POST['gender'],
                ':birth_date' => $_POST['birth_date'],
                ':phone' => $_POST['phone'],
                ':address' => $_POST['address'],
                ':email' => $_POST['email'],
                ':comment' => $_POST['comment'],
                ':id' => $id
            ]);
            $message = '<div class="message success">Запись обновлена</div>';
        } catch (PDOException $e) {
            $message = '<div class="message error">Ошибка: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    }

    $stmt = $pdo->query("SELECT id, last_name, first_name FROM contacts ORDER BY last_name ASC, first_name ASC");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $content = '<div class="contact-links" style="margin-bottom: 10px; display: flex; flex-wrap: wrap; gap: 10px;">';
    if (empty($contacts)) {
        $content .= '<div>Нет записей для редактирования</div>';
    } else {
        foreach ($contacts as $c) {
            $style = ($c['id'] == $id) ? 'background-color: #4caf50; color: white; padding: 5px 10px; border-radius: 5px;' : 'padding: 5px 10px;';
            $initial = !empty($c['first_name']) && mb_strlen($c['first_name']) > 0 ? mb_substr($c['first_name'], 0, 1) . '.' : '';
            $content .= "<a href='index.php?action=edit&id={$c['id']}' style='margin-right: 0; text-decoration: none; $style'>{$c['last_name']} {$initial}</a>";
        }
    }
    $content .= '</div>';

    if ($contact) {
        $currentInfo = "<div class='current-contact' style='margin-bottom: 15px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; font-size: 16px;'>Текущая запись: {$contact['last_name']} {$contact['first_name']} {$contact['middle_name']}</div>";
        $form = '<form method="POST">';
        $form .= '<label>Фамилия: <input type="text" name="last_name" value="' . htmlspecialchars($contact['last_name'] ?? '') . '" required></label><br>';
        $form .= '<label>Имя: <input type="text" name="first_name" value="' . htmlspecialchars($contact['first_name'] ?? '') . '" required></label><br>';
        $form .= '<label>Отчество: <input type="text" name="middle_name" value="' . htmlspecialchars($contact['middle_name'] ?? '') . '"></label><br>';
        $form .= '<label>Пол: <select name="gender"><option value="M" ' . (($contact['gender'] ?? 'M') === 'M' ? 'selected' : '') . '>М</option><option value="F" ' . (($contact['gender'] ?? 'M') === 'F' ? 'selected' : '') . '>Ж</option></select></label><br>';
        $form .= '<label>Дата рождения: <input type="date" name="birth_date" value="' . htmlspecialchars($contact['birth_date'] ?? '') . '" required></label><br>';
        $form .= '<label>Телефон: <input type="text" name="phone" value="' . htmlspecialchars($contact['phone'] ?? '') . '"></label><br>';
        $form .= '<label>Адрес: <input type="text" name="address" value="' . htmlspecialchars($contact['address'] ?? '') . '"></label><br>';
        $form .= '<label>E-mail: <input type="email" name="email" value="' . htmlspecialchars($contact['email'] ?? '') . '"></label><br>';
        $form .= '<label>Комментарий: <textarea name="comment">' . htmlspecialchars($contact['comment'] ?? '') . '</textarea></label><br>';
        $form .= '<button type="submit">Сохранить</button>';
        $form .= '</form>';
        $content .= $currentInfo . $form . $message;
    }

    return $content;
}
?>