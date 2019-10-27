<?php

namespace JRpc;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use JRpc\Validator\JsonValidatorInterface;

class Response implements JsonValidatorInterface
{
    use \JRpc\Validator\JsonValidatorTrait;

    private $status_code;
    private $headers;
    private $body;
    private $contents;

    public function __construct(GuzzleResponse $res)
    {
        $this->status_code = $res->getStatusCode();
        $this->headers = $res->getHeaders();
        $this->body = $res->getBody();
        $this->contents = json_decode($res->getBody());

        // @TODO
        $this->jsonValidate();
    }

    public function getJsonrpcVersion()
    {
        return $this->contents->jsonrpc;
    }

    public function getId()
    {
        return $this->contents->id;
    }

    public function getContents()
    {
        return $this->contents->result;
    }

    public function getStatusCode()
    {
        return $this->status_code;
    }
}
