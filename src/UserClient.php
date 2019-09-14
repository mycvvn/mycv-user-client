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
        $response = $this->client->request('GET', '/api/v1/auth/me', [
            'headers' => [
                'X-Consumer-Custom-ID' => $userId
            ]
        ]);
        if ($response->getStatusCode() === self::STATUS_OK) {
            return json_decode($response->getBody()->getContents());
        }
    }
}
