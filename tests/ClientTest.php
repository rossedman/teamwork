<?php

use Mockery as m;
use Rossedman\Teamwork\Client;

class ClientTest extends PHPUnit_Framework_TestCase {
    
    public function tearDown()
    {
        m::close();
    }

    public function test_that_it_works()
    {
        $client = new Client($guzzle = m::mock('GuzzleHttp\Client'), 'api_key');
    }

}