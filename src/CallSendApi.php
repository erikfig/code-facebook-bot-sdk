<?php

namespace CodeBot;

use GuzzleHttp\Client;

class CallSendApi
{
    const URL = 'https://graph.facebook.com/v2.6/me/messages';
    const URL_PROFILE = 'https://graph.facebook.com/v2.6/me/messenger_profile';
    private $pageAccessToken;

    public function __construct(string $pageAccessToken)
    {
        $this->pageAccessToken = $pageAccessToken;
    }

    public function make(array $message, string $url = null, $method = 'POST') :string
    {
        $client = new Client;
        $url = $url ?? CallSendApi::URL;

        $response = $client->request($method, $url, [
            'json' => $message,
            'query' => ['access_token' => $this->pageAccessToken]
        ]);

        return (string)$response->getBody();
    }
}