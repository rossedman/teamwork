<?php

use Mockery as m;
use Rossedman\Teamwork\Client;

class ClientTest extends PHPUnit_Framework_TestCase {

    protected $guzzle;

    public function setUp()
    {
        parent::setUp();
        $this->guzzle = m::mock('GuzzleHttp\Client');
    }

    public function tearDown()
    {
        m::close();
    }

    /**
     * @group client
     */
    public function test_it_builds_the_request()
    {
        $client = new Client($this->guzzle, 'key', 'http://teamwork.com');

        $this->guzzle
            ->shouldReceive('createRequest')->once()
            ->with('GET', 'http://teamwork.com/packages.json', ['auth' => ['key', 'X'], 'body' => []])
            ->andReturn(m::mock('GuzzleHttp\Message\Request'));

        $returned = $client->buildRequest('packages', 'GET');

        $this->assertInstanceOf('Rossedman\Teamwork\Client', $returned);
        $this->assertInstanceOf('GuzzleHttp\Message\Request', $returned->getRequest());
    }

    /**
     * @group client
     */
    public function test_build_url()
    {
        $client = new Client($this->guzzle, 'key', 'http://teamwork.com/');

        $url = $client->buildUrl('test');

        $this->assertEquals('http://teamwork.com/test.json', $url);
    }

    /**
     * @group client
     */
    public function test_build_url_with_no_trailing_slash()
    {
        $client = new Client($this->guzzle, 'key', 'http://teamwork.com');

        $url = $client->buildUrl('test');

        $this->assertEquals('http://teamwork.com/test.json', $url);
    }

    /**
     * @group client
     */
    public function test_build_url_with_full_url()
    {
        $url = 'http://teamwork.com/authenticate/test/url';
        $expectedUrl = $url . '.json';
        $client = new Client($this->guzzle, 'key', 'http://teamwork.com');

        $actualUrl = $client->buildUrl($url);

        $this->assertEquals($expectedUrl, $actualUrl);
    }
}