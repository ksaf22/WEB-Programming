<?php

class ApiClient 
{
    private string $apiBaseUrl;
    private array $authenticationHeaders;

    public function __construct(string $baseUrl, string $userLogin, string $userPassword) 
    {
        $this->apiBaseUrl = rtrim($baseUrl, '/');
        $credentials = base64_encode("{$userLogin}:{$userPassword}");
        $this->authenticationHeaders = [
            'Authorization: Basic ' . $credentials,
            'Content-Type: application/json'
        ];
    }

    private function executeHttpRequest(
        string $httpMethod, 
        string $apiEndpoint, 
        ?array $requestData = null
    ): array 
    {
        $fullUrl = $this->apiBaseUrl . '/' . ltrim($apiEndpoint, '/');
        $curlHandler = curl_init($fullUrl);

        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($httpMethod),
            CURLOPT_HTTPHEADER => $this->authenticationHeaders
        ];

        if ($requestData !== null) {
            $curlOptions[CURLOPT_POSTFIELDS] = json_encode($requestData);
        }

        curl_setopt_array($curlHandler, $curlOptions);

        $responseContent = curl_exec($curlHandler);
        $errorMessage = curl_error($curlHandler);
        $httpStatusCode = curl_getinfo($curlHandler, CURLINFO_HTTP_CODE);
        curl_close($curlHandler);

        return [
            'http_status' => $httpStatusCode,
            'error' => $errorMessage ?: null,
            'response_data' => json_decode($responseContent, true)
        ];
    }

    public function fetchData(string $endpoint): array 
    {
        return $this->executeHttpRequest('GET', $endpoint);
    }

    public function sendData(string $endpoint, array $payload): array 
    {
        return $this->executeHttpRequest('POST', $endpoint, $payload);
    }

    public function updateData(string $endpoint, array $payload): array 
    {
        return $this->executeHttpRequest('PUT', $endpoint, $payload);
    }

    public function removeData(string $endpoint): array 
    {
        return $this->executeHttpRequest('DELETE', $endpoint);
    }
}