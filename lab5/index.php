<?php
$categories = ['Авто', 'Мото', 'Велосипеды'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $category = $_POST['category'] ?? '';
    $title = $_POST['title'] ?? '';
    $text = $_POST['text'] ?? '';


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Некорректный email';
    } elseif (!in_array($category, $categories)) {
        $error = 'Выберите категорию';
    } elseif (empty($title) || empty($text)) {
        $error = 'Заполните все поля';
    } else {
        $safe_title = preg_replace('/[^\p{L}\d\s]/u', '', $title); // Удаляем спецсимволы
        $safe_title = str_replace(' ', '_', $safe_title); // Замена пробелов
        $filename = "{$category}/{$safe_title}_" . time() . '.txt'; // Уникальное имя

        if (!is_dir($category)) {
            mkdir($category, 0777, true);
        }

        $content = "Email: $email\nКатегория: $category\nЗаголовок: $title\nТекст: $text";
        if (file_put_contents($filename, $content)) {
            $success = 'Объявление добавлено!';
        } else {
            $error = 'Ошибка при сохранении';
        }
    }
}

$ads = [];
foreach ($categories as $cat) {
    $files = glob("{$cat}/*.txt");
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $data = [
            'email' => '',
            'category' => $cat,
            'title' => basename($file, '.txt'),
            'text' => $content,
        ];
        preg_match('/Email: (.*)/', $content, $email_match);
        preg_match('/Заголовок: (.*)/', $content, $title_match);
        if ($email_match) $data['email'] = $email_match[1];
        if ($title_match) $data['title'] = $title_match[1];
        $ads[] = $data;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Доска объявлений (Авто, Мото, Велосипеды)</title>
    <style>
        table { border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h1>Добавить объявление</h1>
    <?php if ($error): ?>
        <div style="color: red;"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div style="color: green;"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Категория:
            <select name="category" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat ?>"><?= $cat ?></option>
                <?php endforeach; ?>
            </select>
        </label><br><br>
        <label>Заголовок: <input type="text" name="title" required></label><br><br>
        <label>Текст объявления: <textarea name="text" rows="4" required></textarea></label><br><br>
        <button type="submit">Добавить</button>
    </form>

    <h2>Актуальные объявления</h2>
    <?php if (empty($ads)): ?>
        <p>Объявлений пока нет.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Email</th>
                <th>Категория</th>
                <th>Заголовок</th>
                <th>Текст</th>
            </tr>
            <?php foreach ($ads as $ad): ?>
                <tr>
                    <td><?= htmlspecialchars($ad['email']) ?></td>
                    <td><?= htmlspecialchars($ad['category']) ?></td>
                    <td><?= htmlspecialchars($ad['title']) ?></td>
                    <td><?= nl2br(htmlspecialchars($ad['text'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
