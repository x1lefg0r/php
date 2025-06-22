<?php
function getMenu() {
    $actions = ['view' => 'Просмотр', 'add' => 'Добавление записи', 'edit' => 'Редактирование записи', 'delete' => 'Удаление записи'];
    $active = $_GET['action'] ?? 'view';
    $sortOptions = ['created_at' => 'По дате добавления', 'last_name' => 'По фамилии', 'birth_date' => 'По дате рождения'];
    $activeSort = $_GET['sort'] ?? 'created_at';

    $menu = '<div style="margin-bottom: 20px;">';
    foreach ($actions as $key => $label) {
        $color = ($active === $key) ? 'red' : 'blue';
        $menu .= "<a href='index.php?action=$key' style='color: $color; text-decoration: none; margin-right: 10px; font-size: 16px;'>$label</a>";
    }
    $menu .= '</div>';

    if ($active === 'view') {
        $menu .= '<div style="margin-left: 10px;">';
        foreach ($sortOptions as $key => $label) {
            $color = ($activeSort === $key) ? 'red' : 'blue';
            $menu .= "<a href='index.php?action=view&sort=$key' style='color: $color; text-decoration: none; margin-right: 10px; font-size: 14px;'>$label</a>";
        }
        $menu .= '</div>';
    }

    return $menu;
}
?>