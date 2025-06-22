<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
        include 'menu.php';
        echo getMenu();

        $action = $_GET['action'] ?? 'view';
        $sort = $_GET['sort'] ?? 'created_at';
        $page = $_GET['page'] ?? 1;

        switch ($action) {
            case 'view':
                include 'viewer.php';
                echo getViewerContent($sort, $page);
                break;
            case 'add':
                include 'add.php';
                echo getAddForm();
                break;
            case 'edit':
                include 'edit.php';
                echo getEditForm();
                break;
            case 'delete':
                include 'delete.php';
                echo getDeleteContent();
                break;
        }
        ?>
    </div>
</body>
</html>