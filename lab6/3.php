<?php


function processHttpRequest(
    string $endpoint, 
    string $method = 'GET', 
    $payload = null, 
    array $customHeaders = []
) {
    $curlSession = curl_init($endpoint);
    
    curl_setopt_array($curlSession, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_FAILONERROR => false
    ]);

    if ($method === 'POST') {
        curl_setopt($curlSession, CURLOPT_POST, true);
    } elseif (in_array($method, ['PUT', 'DELETE'], true)) {
        curl_setopt($curlSession, CURLOPT_CUSTOMREQUEST, $method);
    }

    if ($payload !== null) {
        if (is_array($payload)) {
            $payload = json_encode($payload, JSON_THROW_ON_ERROR);
            array_push($customHeaders, 'Content-Type: application/json');
        }
        curl_setopt($curlSession, CURLOPT_POSTFIELDS, $payload);
    }

    if (!empty($customHeaders)) {
        curl_setopt($curlSession, CURLOPT_HTTPHEADER, $customHeaders);
    }

    $responseBody = curl_exec($curlSession);
    $curlError = curl_error($curlSession);
    $statusCode = curl_getinfo($curlSession, CURLINFO_HTTP_CODE);
    curl_close($curlSession);

    // Логирование результатов
    echo "========================\n";
    if ($curlError) {
        echo "[CURL ERROR] $curlError\n";
    } elseif ($statusCode >= 400) {
        echo "[HTTP $statusCode ERROR]\n$responseBody\n";
    } else {
        echo "[SUCCESS] HTTP $statusCode\n";
        $parsedData = json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);
        print_r($parsedData);
    }
    echo "\n";
}

echo "Тест успешного GET-запроса:\n";
processHttpRequest('https://jsonplaceholder.typicode.com/posts/1');

echo "Тест 404 ошибки:\n";
processHttpRequest('https://jsonplaceholder.typicode.com/posts/999999', 'GET');

echo "Тест несуществующего домена:\n";
@processHttpRequest('https://invalid.domain.example');