<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\RestfulTrait;

class Time extends AbstractObject {

    use RestfulTrait;

    protected $wrapper  = 'time-entry';

    protected $endpoint = 'time_entries';

}