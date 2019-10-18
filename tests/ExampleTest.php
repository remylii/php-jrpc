<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use JRpc\Client;

class ExampleTest extends TestCase
{
    public function testHello()
    {
        $client = new Client();
        $expected = "Hello, world!";
        $this->assertSame($expected, $client->hello());
    }
}

