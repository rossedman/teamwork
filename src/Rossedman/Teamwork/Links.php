<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\RestfulTrait;

class Links extends Object {

    use RestfulTrait;

    protected $wrapper  = 'link';

    protected $endpoint = 'links';

}