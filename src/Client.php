<?php

namespace JRpc;

use JRpc\Lib\Logger;

class Client extends \JRpc\AbstractClient
{
    public function request(string $endpoint, string $method, ?array $params = [], ?string $id = null)
    {
        try {
            $res = $this->doRequest($endpoint, $method, $params, $id);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Logger::debug($e);
        } catch (\Throwable $e) {
            Logger::error($e);
        }

        Logger::debug($res->getStatusCode());
        return;
    }
}
