<?php
function httpCall($endpoint, $httpMethod = 'GET', $payload = null) {
    $curlSession = curl_init($endpoint);
    
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    switch (strtoupper($httpMethod)) {
        case 'POST':
            curl_setopt($curlSession, CURLOPT_POST, true);
            break;
        case 'PUT':
        case 'PATCH':
        case 'DELETE':
            curl_setopt($curlSession, CURLOPT_CUSTOMREQUEST, $httpMethod);
            break;
    }
    

    if ($payload !== null) {
        $jsonData = json_encode($payload, JSON_UNESCAPED_SLASHES);
        curl_setopt($curlSession, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($curlSession, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ]);
    }
    

    $result = curl_exec($curlSession);
    curl_close($curlSession);
    
    return $result;
}


echo "GET Response:\n" . httpCall('https://jsonplaceholder.typicode.com/posts/1') . "\n\n";
echo "POST Response:\n" . httpCall(
    'https://jsonplaceholder.typicode.com/posts',
    'POST',
    ['title' => 'Hello', 'body' => 'World', 'userId' => 1]
) . "\n\n";
echo "PUT Response:\n" . httpCall(
    'https://jsonplaceholder.typicode.com/posts/1',
    'PUT',
    ['title' => 'Updated Title', 'body' => 'New Content']
) . "\n\n";
echo "DELETE Response:\n" . httpCall(
    'https://jsonplaceholder.typicode.com/posts/1',
    'DELETE'
) . "\n\n";
?>
