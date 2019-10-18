<?php

namespace JRpc;

use GuzzleHttp\Client as GuzzleClient;
use JRpc\Lib\Logger;

class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    public function hello(): string
    {
        $str = "Hello, world!";
        Logger::write($str);
        return $str;
    }
}
