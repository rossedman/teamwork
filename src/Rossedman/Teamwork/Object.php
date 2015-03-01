<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\Contracts\Requestable;

abstract class Object {

    protected $client;

    public function __construct(Requestable $client)
    {
        $this->client = $client;
    }

    public function get()
    {
        //..
    }

    public function post()
    {
        //..
    }

    public function put()
    {
        //..
    }

    public function delete()
    {
        //..
    }

}