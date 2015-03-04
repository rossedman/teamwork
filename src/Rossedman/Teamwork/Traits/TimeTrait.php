<?php  namespace Rossedman\Teamwork\Traits; 

trait TimeTrait {

    /**
     * Time Entries
     * GET /projects/{id}/time_entries.json
     *
     * @return mixed
     */
    public function time()
    {
        return $this->client->get("$this->endpoint/$this->id/time_entries")->response();
    }

    /**
     * Create Time Entry
     * POST /projects/{id}/time_entries.json
     *
     * @param $data
     *
     * @return mixed
     */
    public function createTime($data)
    {
        return $this->client->post("$this->endpoint/$this->id/time_entries", ['time-entry' => $data])->response();
    }

}