<?php namespace Rossedman\Teamwork;

use GuzzleHttp\Client as Guzzle;

class Client {

    protected $guzzle;

    protected $request;

    public function __construct(Guzzle $guzzle, $key)
    {
        $this->guzzle = $guzzle;
        $this->key = $key;
    }

}
