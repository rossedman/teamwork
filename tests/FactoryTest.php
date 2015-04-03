<?php

use Mockery as m;
use Rossedman\Teamwork\Factory;

class FactoryTest extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        parent::setUp();
        $this->requestable = m::mock('Rossedman\Teamwork\Contracts\Requestable');
    }

    public function tearDown()
    {
        m::close();
    }

    public function test_that_it_returns_new_objects()
    {
        $factory = new Factory($this->requestable);

        $this->assertInstanceOf('Rossedman\Teamwork\Account', $factory->account());
        $this->assertInstanceOf('Rossedman\Teamwork\Activity', $factory->activity());
        $this->assertInstanceOf('Rossedman\Teamwork\Category', $factory->category());
        $this->assertInstanceOf('Rossedman\Teamwork\Comment', $factory->comment());
        $this->assertInstanceOf('Rossedman\Teamwork\Company', $factory->company());
        $this->assertInstanceOf('Rossedman\Teamwork\Message', $factory->message());
        $this->assertInstanceOf('Rossedman\Teamwork\Milestone', $factory->milestone());
        $this->assertInstanceOf('Rossedman\Teamwork\Notebook', $factory->notebook());
        $this->assertInstanceOf('Rossedman\Teamwork\People', $factory->people());
        $this->assertInstanceOf('Rossedman\Teamwork\Links', $factory->links());
        $this->assertInstanceOf('Rossedman\Teamwork\Time', $factory->time());
        $this->assertInstanceOf('Rossedman\Teamwork\Task', $factory->task());
    }

    /**
     * @expectedException \Rossedman\Teamwork\Exceptions\ClassNotCreatedException
     */
    public function test_that_it_fails_when_object_does_not_exist()
    {
        $factory = new Factory($this->requestable);
        $factory->butts();
    }

    public function test_that_it_parses_parameters()
    {
        $factory = new Factory($this->requestable);
        $activity = $factory->activity(30);

        $this->assertObjectHasAttribute('id', $activity);
        $this->assertEquals(30, $activity->getID());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_that_it_only_accepts_id_as_parameter()
    {
        $factory = new Factory($this->requestable);
        $factory->activity('butts');
    }
}