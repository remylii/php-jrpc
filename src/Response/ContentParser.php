<?php

namespace JRpc\Response;

use JRpc\Exception\InvalidJsonFormatException;
use JRpc\Exception\InvalidParamException;
use JRpc\Exception\InvalidRequestFormatException;
use JRpc\Exception\MethodNotFoundException;
use JRpc\Exception\ResponseFailureException;

class ContentParser
{
    public static function parse(\StdClass $contents)
    {
        if (property_exists($contents, "error")) {
            if (!$contents->error instanceof \StdClass || !property_exists($contents->error, "code")) {
                throw new ResponseFailureException("Invalid response format");
            }

            switch ($contents->error->code) {
                case -32700:
                    throw new InvalidJsonFormatException($contents->error->message);
                    break;
                case -32600:
                    throw new InvalidRequestFormatException($contents->error->message);
                    break;
                case -32601:
                    throw new MethodNotFoundException($contents->error->message);
                    break;
                case -32602:
                    throw new InvalidParamException($contents->error->message);
                    break;
                case -32603:
                    // Server error
                default:
                    throw new ResponseFailureException($contents->error->message);
                    break;
            }

        }

        if (property_exists($contents, "result")) {
            return $contents->result;
        }

        throw new \ResponseFailureException("contents property not exists result or error");
    }
}
