<?php

use Mockery as m;

class ObjectTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function test_it_has_client_injected()
    {
        $object = new ObjectStub($client = m::mock('Rossedman\Teamwork\Contracts\Requestable'));
        $this->assertObjectHasAttribute('client', $object);
    }

}

class ObjectStub extends \Rossedman\Teamwork\Object {

}