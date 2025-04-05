<?php
session_start();

if (!isset($_SESSION['company'])) {
    header('Location: form.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ваши данные</title>
</head>
<body>
    <h1>Ваши рабочие данные</h1>
    <p><strong>Компания:</strong> <?= htmlspecialchars($_SESSION['company']) ?></p>
    <p><strong>Должность:</strong> <?= htmlspecialchars($_SESSION['position']) ?></p>
    <p><strong>Зарплата:</strong> <?= htmlspecialchars($_SESSION['salary']) ?></p>
    
    <a href="form.php">Вернуться к форме</a>
</body>
</html>
