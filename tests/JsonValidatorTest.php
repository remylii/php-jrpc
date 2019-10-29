<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use JRpc\Client;

class JsonValidatorTest extends TestCase
{
    /**
     * @dataProvider jsonValidateProvider
     */
    public function testJsonValidate($expect_exception, $expect_exception_msg, $param)
    {
        $class = new class implements \JRpc\Validator\JsonValidatorInterface {
            use \JRpc\Validator\JsonValidatorTrait;
        };

        $this->expectException($expect_exception);
        $this->expectExceptionMessage($expect_exception_msg);
        json_decode($param);
        $class->jsonValidate();
    }

    public function jsonValidateProvider(): array
    {
        return [
            "JSON_ERROR_SYNTAX" => [
                \JRpc\Exception\InvalidJsonFormatException::class, "JSON_ERROR_SYNTAX", "string"
            ],
        ];
    }
}
