<?php
function transformEverySecondWord(&$words) {
    foreach ($words as $key => &$word) {
        if ($key % 2 == 1) {
            $word = mb_strtoupper($word);
        }
    }
}

$text = $_POST['text'] ?? '';

$words = preg_split('/\s+/', $text);

transformEverySecondWord($words);

$result = implode(' ', $words);

echo "<h2>Исходный текст:</h2>";
echo "<p>" . htmlspecialchars($text) . "</p>";

echo "<h2>Преобразованный текст:</h2>";
echo "<p>" . htmlspecialchars($result) . "</p>";
?>