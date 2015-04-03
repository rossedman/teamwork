<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\Traits\RestfulTrait;

class Milestone extends Object {

    use RestfulTrait;

    protected $wrapper  = 'milestone';

    protected $endpoint = 'milestones';

    /**
     * PUT /milestones/{id}/complete.json
     *
     * @param array $data
     *
     * @return
     */
    public function complete($data = [])
    {
        return $this->client->put("$this->endpoint/$this->id/complete", [$this->wrapper => $data])->response();
    }

    /**
     * PUT /milestones/{id}/uncomplete.json
     *
     * @param array $data
     *
     * @return
     */
    public function uncomplete($data = [])
    {
        return $this->client->put("$this->endpoint/$this->id/uncomplete", [$this->wrapper => $data])->response();
    }

}