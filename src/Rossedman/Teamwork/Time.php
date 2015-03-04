<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\RestfulTrait;

class Time extends Object {

    use RestfulTrait;

    protected $wrapper  = 'time-entry';

    protected $endpoint = 'time_entries';

}