<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\Traits\TimeTrait;
use Rossedman\Teamwork\Traits\RestfulTrait;

class Task extends AbstractObject {

    use RestfulTrait, TimeTrait;

    protected $wrapper  = 'task';

    protected $endpoint = 'tasks';

    /**
     * Time Totals
     * GET /projects/{id}/time/total.json
     *
     * @return mixed
     */
    public function timeTotal()
    {
        return $this->client->get("$this->endpoint/$this->id/time/total")->response();
    }

}