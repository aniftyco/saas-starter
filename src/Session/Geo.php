<?php

namespace NiftyCo\Support\Session;

use GuzzleHttp\Client;

class Geo
{
    const BASE_URL = 'http://ip-api.com/json';

    public function __construct(private Client $client)
    {
        //
    }

    public function lookup(string $ip, $json = false): array|string
    {
        $response = $this->client->get(self::BASE_URL . '/' . $ip);

        $data = json_decode($response->getBody()->getContents(), true);

        return $this->prepare($data, $json);
    }

    private function prepare(array $data, $json = false): array|string
    {
        $geo = [
            'city' => $data['city'],
            'region' => $data['regionName'],
            'country' => $data['country'],
            'isp' => $data['isp'],
        ];

        return $json ? json_encode($geo) : $geo;
    }
}
