<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\RestfulTrait;

class Message extends Object {

    use RestfulTrait;

    protected $wrapper  = 'message';

    protected $endpoint = 'messages';

    public function create()
    {
        //.. Creation must be overridden and in the scope of a project
    }
}