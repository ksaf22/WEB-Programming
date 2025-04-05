<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['company'] = $_POST['company'] ?? '';
    $_SESSION['position'] = $_POST['position'] ?? '';
    $_SESSION['salary'] = $_POST['salary'] ?? '';
    
    header('Location: display.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ввод данных</title>
</head>
<body>
    <h1>Введите данные о работе</h1>
    <form method="POST">
        <p>
            <label>Название компании:</label>
            <input type="text" name="company" required>
        </p>
        <p>
            <label>Должность:</label>
            <input type="text" name="position" required>
        </p>
        <p>
            <label>Зарплата:</label>
            <input type="number" name="salary" required>
        </p>
        <button type="submit">Сохранить</button>
    </form>
</body>
</html>
