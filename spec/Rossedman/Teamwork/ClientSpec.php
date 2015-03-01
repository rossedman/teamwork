<?php namespace spec\Rossedman\Teamwork;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Rossedman\Teamwork\Client');
    }
}
