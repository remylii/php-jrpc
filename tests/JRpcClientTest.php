<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use JRpc\Client;

class JrpcClientTest extends TestCase
{
    public function testRequest()
    {
        $client = new Client();
        $client->request("http://localhost:8000/api/test", "list", []);
    }
}

