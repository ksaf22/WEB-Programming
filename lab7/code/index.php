<?php

$mysqli = new mysqli('db', 'root', 'helloworld', 'web');

if (mysqli_connect_errno()) {
    printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $mysqli->real_escape_string($_POST['email']);
    $title = $mysqli->real_escape_string($_POST['title']);
    $category = $mysqli->real_escape_string($_POST['category']);
    $description = $mysqli->real_escape_string($_POST['description']);

    $query = "INSERT INTO ad (email, title, description, category) VALUES ('$email', '$title', '$description', '$category')";
    $mysqli->query($query);
}

$advertisements = [];
if ($result = $mysqli->query('SELECT * FROM ad ORDER BY created DESC')) {
    while ($row = $result->fetch_assoc()) {
        $advertisements[] = $row;
    }
    $result->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>доска</title>
</head>
<body>

<form method="post">
    email: <input type="email" name="email"><br>
    название: <input type="text" name="title"><br>
    категория:
    <select name="category">
        <option>cars</option>
        <option>motorcycles</option>
        <option>boats</option>
    </select><br>
    описание: <label>
        <textarea name="description"></textarea>
    </label><br>
    <button>добавить</button>
</form>

<h3>объявления:</h3>
<table>
    <tr>
        <td><b>email</b></td>
        <td><b>название</b></td>
        <td><b>описание</b></td>
        <td><b>категория</b></td>
    </tr>
    <?php foreach ($advertisements as $ad): ?>
        <tr>
            <td><?=$ad['email']?></td>
            <td><?=$ad['title']?></td>
            <td><?=$ad['description']?></td>
            <td><?=$ad['category']?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
