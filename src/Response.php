<?php

namespace JRpc;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response
{
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

        if (json_last_error() != JSON_ERROR_NONE) {
            // error
        }
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
