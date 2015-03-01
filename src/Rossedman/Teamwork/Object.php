<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\Contracts\Requestable;

abstract class Object {

    protected $client;

    protected $request;

    public function __construct(Requestable $client)
    {
        $this->client = $client;
    }

}