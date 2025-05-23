<?php

function performGetWithHeaders(string $targetUrl, array $customHeaders) {
    $curlHandler = curl_init();

    curl_setopt($curlHandler, CURLOPT_URL, $targetUrl);
    curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $customHeaders);
    
    $serverResponse = curl_exec($curlHandler);
    curl_close($curlHandler); 
    
    return $serverResponse;
}

function postJsonPayload(string $apiEndpoint, array $payloadData) {
    $curlHandler = curl_init();
    $jsonData = json_encode($payloadData);
    
    curl_setopt($curlHandler, CURLOPT_URL, $apiEndpoint);
    curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlHandler, CURLOPT_POST, true);
    curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($curlHandler, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ]);
    
    $serverResponse = curl_exec($curlHandler);
    curl_close($curlHandler);
    
    return $serverResponse;
}

//выполнение запроса с параметрами URL
function executeQueryWithParams(string $baseUrl, array $urlParameters) {
    $queryString = http_build_query($urlParameters);
    $fullUrl = $baseUrl . '?' . $queryString;
    
    $curlHandler = curl_init();
    curl_setopt($curlHandler, CURLOPT_URL, $fullUrl);
    curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
    
    $serverResponse = curl_exec($curlHandler);
    curl_close($curlHandler);
    
    return $serverResponse;
}


$result = performGetWithHeaders('https://api.example.com/data', ['Authorization: Bearer token']);

$response = postJsonPayload('https://api.example.com/create', ['title' => 'Test', 'body' => 'Content']);

$data = executeQueryWithParams('https://api.example.com/search', ['query' => 'php', 'page' => 2]);
*/
