<?php
function getDeleteContent() {
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=contacts_db;user=postgres;password=eg0rka6002006");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'] ?? null;
    $message = '';
    if ($id) {
        try {
            $stmt = $pdo->prepare("SELECT last_name FROM contacts WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $contact = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($contact) {
                $deleteStmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
                $deleteStmt->execute([':id' => $id]);
                $message = '<div class="message success">Запись с фамилией ' . htmlspecialchars($contact['last_name']) . ' удалена</div>';
                // $message .= '<script>window.location.href = "index.php?action=delete";</script>';
            } else {
                $message = '<div class="message error">Запись с ID ' . htmlspecialchars($id) . ' не найдена</div>';
            }
        } catch (PDOException $e) {
            $message = '<div class="message error">Ошибка: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    }

    $stmt = $pdo->query("SELECT id, last_name, SUBSTRING(first_name FROM 1 FOR 1) as initial FROM contacts ORDER BY last_name ASC");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $links = '<div>';
    foreach ($contacts as $c) {
        $links .= "<a href='index.php?action=delete&id={$c['id']}' style='margin-right: 10px; text-decoration: none; color: blue;'>{$c['last_name']} {$c['initial']}.</a>";
    }
    $links .= '</div>';
    $links .= $message;

    return $links;
}
?>