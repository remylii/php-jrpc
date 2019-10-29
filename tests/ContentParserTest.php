<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use JRpc\Response\ContentParser;

class ContentParserTest extends TestCase
{
    /**
     * @dataProvider parseProvider
     */
    public function testParse($expect_exception, $param)
    {
        $contents = json_decode($param);

        $this->expectException($expect_exception);
        ContentParser::parse($contents);
    }

    public function parseProvider(): array
    {
        $res = [
            "jsonrpc" => "2.0",
            "id"      => "123456",
        ];

        return [
            "errorだけどcodeがない" => [
                \JRpc\Exception\ResponseFailureException::class, json_encode(array_merge($res, [
                    "error" => [],
                ]))
            ],
            "parse error" => [
                \JRpc\Exception\InvalidJsonFormatException::class, json_encode(array_merge($res, [
                    "error" => [
                        "code" => -32700,
                        "message" => "Parse Error"
                    ],
                ]))
            ],
            "Invalid Request" => [
                \JRpc\Exception\InvalidRequestFormatException::class, json_encode(array_merge($res, [
                    "error" => [
                        "code" => -32600,
                        "message" => "Invalid Request"
                    ],
                ]))
            ],
            "	Method not found" => [
                \JRpc\Exception\MethodNotFoundException::class, json_encode(array_merge($res, [
                    "error" => [
                        "code" => -32601,
                        "message" => "	Method not found"
                    ],
                ]))
            ],
            "Invalid params" => [
                \JRpc\Exception\InvalidParamException::class, json_encode(array_merge($res, [
                    "error" => [
                        "code" => -32602,
                        "message" => "Invalid params"
                    ],
                ]))
            ],
            "Server Error" => [
                \JRpc\Exception\ResponseFailureException::class, json_encode(array_merge($res, [
                    "error" => [
                        "code" => -1,
                        "message" => "Server Error"
                    ],
                ]))
            ],
        ];
    }
}
