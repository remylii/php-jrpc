<?php

namespace JRpc;

use GuzzleHttp\Client as GuzzleClient;
use Ramsey\Uuid\Uuid;
use JRpc\Response\Response;

abstract class AbstractClient
{
    const TIMEOUT = 180;

    /**
     * @var \Guzzle\Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    protected function doRequest(string $endpoint, string $method, array $params, ?string $id): Response
    {
        $res = $this->client->request(
            'POST',
            $endpoint,
            [
                "timeout" => self::TIMEOUT,
                'form_params' => [
                    "jsonrpc" => "2.0",
                    "id" => $id ?? Uuid::uuid4()->toString(),
                    "method" => $method,
                    "params" => $params,
                ],
            ]
        );

        \JRpc\Lib\Logger::debug("", json_decode($res->getBody(), true));

        return new response($res);
    }
}
