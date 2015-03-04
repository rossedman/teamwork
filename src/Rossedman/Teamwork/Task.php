<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\Traits\TimeTrait;
use Rossedman\Teamwork\Traits\RestfulTrait;

class Task extends Object {

    use RestfulTrait, TimeTrait;

    public function complete(){}

    public function uncomplete(){}

}