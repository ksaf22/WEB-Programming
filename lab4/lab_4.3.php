<?php
$upperCount = 0;
$lowerCount = 0;
$text = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
    $text = $_POST['text'];
    
    // Подсчет заглавных и строчных букв
    for ($i = 0; $i < mb_strlen($text); $i++) {
        $char = mb_substr($text, $i, 1);
        if (mb_ereg_match('[А-ЯA-Z]', $char)) {
            $upperCount++;
        } elseif (mb_ereg_match('[а-яa-z]', $char)) {
            $lowerCount++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подсчет букв</title>
</head>
<body>
    <form method="POST">
        <textarea name="text" rows="5" cols="50"><?= htmlspecialchars($text) ?></textarea><br>
        <button type="submit">Посчитать буквы</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h3>Результат:</h3>
        <p>Заглавных букв: <?= $upperCount ?></p>
        <p>Строчных букв: <?= $lowerCount ?></p>
    <?php endif; ?>
</body>
</html>
