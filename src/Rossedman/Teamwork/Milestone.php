<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\Traits\RestfulTrait;

class Milestone extends AbstractObject {

    use RestfulTrait;

    protected $wrapper  = 'milestone';

    protected $endpoint = 'milestones';

    /**
     * GET /milestones.json
     *
     * @param null $args
     *
     * @return mixed
     */
    public function all($args = null)
    {
        $this->areArgumentsValid($args, ['getProgress']);

        return $this->client->get($this->endpoint, $args)->response();
    }

    /**
     * GET /milestones/{milestone_id}.json
     *
     * @param null $args
     *
     * @return mixed
     */
    public function find($args = null)
    {
        $this->areArgumentsValid($args, ['getProgress', 'showTaskLists', 'showTasks']);

        return $this->client->get("$this->endpoint/$this->id", $args)->response();
    }

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