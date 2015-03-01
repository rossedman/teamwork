<?php  namespace Rossedman\Teamwork; 

use GuzzleHttp\Client as Guzzle;
use Rossedman\Teamwork\Contracts\Requestable;

class Client implements Requestable {

    protected $client;

    public function __construct(Guzzle $client)
    {
        $this->client = $client;
    }

}