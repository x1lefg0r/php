<?php
function getViewerContent($sort, $page) {
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=contacts_db;user=postgres;password=eg0rka6002006");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $perPage = 10;
    $offset = ($page - 1) * $perPage;
    $sortMap = ['created_at' => 'created_at ASC', 'last_name' => 'last_name ASC', 'birth_date' => 'birth_date ASC'];
    $sortSql = $sortMap[$sort] ?? 'created_at ASC';

    $stmt = $pdo->prepare("SELECT * FROM contacts ORDER BY $sortSql LIMIT $1 OFFSET $2");
    $stmt->execute([$perPage, $offset]);
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalStmt = $pdo->query("SELECT COUNT(*) FROM contacts");
    $total = $totalStmt->fetchColumn();
    $totalPages = ceil($total / $perPage);

    $content = '<table border="1">';
    $content .= '<tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Пол</th><th>Дата рождения</th><th>Телефон</th><th>Адрес</th><th>E-mail</th><th>Комментарий</th></tr>';
    foreach ($contacts as $contact) {
        $content .= '<tr>';
        $content .= '<td>' . htmlspecialchars($contact['last_name']) . '</td>';
        $content .= '<td>' . htmlspecialchars($contact['first_name']) . '</td>';
        $content .= '<td>' . htmlspecialchars($contact['middle_name'] ?? '') . '</td>';
        $content .= '<td>' . htmlspecialchars($contact['gender']) . '</td>';
        $content .= '<td>' . htmlspecialchars($contact['birth_date']) . '</td>';
        $content .= '<td>' . htmlspecialchars($contact['phone'] ?? '') . '</td>';
        $content .= '<td>' . htmlspecialchars($contact['address'] ?? '') . '</td>';
        $content .= '<td>' . htmlspecialchars($contact['email'] ?? '') . '</td>';
        $content .= '<td>' . htmlspecialchars($contact['comment'] ?? '') . '</td>';
        $content .= '</tr>';
    }
    $content .= '</table>';

    if ($totalPages > 1) {
        $content .= '<div>';
        for ($i = 1; $i <= $totalPages; $i++) {
            $content .= "<a href='index.php?action=view&sort=$sort&page=$i' style='margin-right: 10px; text-decoration: none; color: blue;' onmouseover=\"this.style.border='2px solid black';\" onmouseout=\"this.style.border='none';\">$i</a>";
        }
        $content .= '</div>';
    }

    return $content;
}
?>