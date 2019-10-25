<?php

namespace JRpc;

use JRpc\Lib\Logger;

class Client extends \JRpc\AbstractClient
{
    public function request(string $endpoint, string $method, ?array $params = [], ?string $id = null)
    {
        try {
            $response = $this->doRequest($endpoint, $method, $params, $id);

            var_dump($response);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Logger::error($e);
            throw $e;
        } catch (\Throwable $e) {
            Logger::error($e);
            throw $e;
        }

        return $response;
    }
}
