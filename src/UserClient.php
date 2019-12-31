<?php

namespace MyCV\User;

use GuzzleHttp\Client;

class UserClient
{
    const STATUS_OK = 200;

    protected $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => env('USER_SERVICE_URL')
        ]);
    }

    /**
     * Get info an user by user id
     */
    public function getInfo($userId)
    {
        $response = $this->client->request('GET', '/api/auth/me', [
            'headers' => [
                'X-Consumer-Custom-ID' => $userId
            ]
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode >= 200 && $statusCode < 400) {
            return json_decode($response->getBody()->getContents());
        }
    }

    /**
     * Analytics
     */
    public function analytics($userId, $formParams)
    {
        $response = $this->client->request('PUT', '/api/analytics', [
            'form_params' => $formParams,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-Consumer-Custom-ID' => $userId
            ]
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode >= 200 && $statusCode < 400) {
            return json_decode($response->getBody()->getContents());
        }
    }
}
