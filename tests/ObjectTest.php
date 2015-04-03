<?php

use Mockery as m;

class ObjectTest extends PHPUnit_Framework_TestCase {

    protected $object;

    public function setUp()
    {
        parent::setup();
        $request = m::mock('Rossedman\Teamwork\Contracts\RequestableInterface');
        $this->object = new ObjectStub($request);
    }

    public function tearDown()
    {
        m::close();
    }

    /**
     * @group object
     */
    public function test_it_has_client_injected()
    {
        $this->assertObjectHasAttribute('client', $this->object);
    }

    /**
     * @group object
     */
    public function test_if_arguments_are_valid()
    {
        $args = ['testArg' => 2, 'testArg2' => 3];
        $accepted = ['testArg', 'testArg2'];

        $return = $this->object->valid_args($args, $accepted);

        $this->assertTrue($return);
    }

    /**
     * @group object
     */
    public function test_if_arguments_are_null()
    {
        $return = $this->object->valid_args(null, []);

        $this->assertNull($return);
    }

    /**
     * @group object
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage This call only accepts these arguments: testArg | testArg2
     */
    public function test_if_arguments_do_not_match_exception_is_thrown()
    {
        $this->object->valid_args(['whatever' => 1], ['testArg', 'testArg2']);
    }

}

class ObjectStub extends \Rossedman\Teamwork\AbstractObject {

    public function valid_args($args, $accepted)
    {
        return $this->areArgumentsValid($args, $accepted);
    }

}