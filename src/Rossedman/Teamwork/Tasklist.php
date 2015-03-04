<?php  namespace Rossedman\Teamwork; 

class Tasklist extends Object {

    protected $wrapper  = 'tasklist';

    protected $endpoint = 'tasklists';

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