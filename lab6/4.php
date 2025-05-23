<?php
require_once 'ApiClient.php';

$apiHandler = new ApiClient(
    'https://httpbin.org',
    'test_user',
    'test_password'
);

echo "=== ПРОВЕРКА АУТЕНТИФИКАЦИИ (GET) ===\n";
$authCheck = $apiHandler->get('/basic-auth/test_user/test_password');
print_r($authCheck);

echo "\n=== СОЗДАНИЕ ЗАПИСИ (POST) ===\n";
$newEntry = $apiHandler->post('/anything', [
    'header' => 'Тестовый заголовок',
    'content' => 'Пример содержимого'
]);
print_r($newEntry);

echo "\n=== ОБНОВЛЕНИЕ ДАННЫХ (PUT) ===\n";
$updateResult = $apiHandler->put('/anything', [
    'id' => 123,
    'changes' => ['status' => 'updated']
]);
print_r($updateResult);

echo "\n=== УДАЛЕНИЕ РЕСУРСА (DELETE) ===\n";
$deleteStatus = $apiHandler->delete('/anything');
print_r($deleteStatus);

echo "\n// Все операции завершены";