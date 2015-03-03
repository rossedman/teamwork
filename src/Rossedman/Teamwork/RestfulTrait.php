<?php  namespace Rossedman\Teamwork; 

trait RestfulTrait {

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->client->get($this->endpoint)->response();
    }

    /**
     * @return mixed
     */
    public function find()
    {
        return $this->client->get("$this->endpoint/$this->id")->response();
    }

    /**
     * @return array | companyID
     */
    public function create($data)
    {
        return $this->client->post("$this->endpoint", [$this->wrapper => $data])->response();
    }

    /**
     * @return mixed
     */
    public function update($data)
    {
        return $this->client->put("$this->endpoint/$this->id", [$this->wrapper => $data])->response();
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        return $this->client->delete("$this->endpoint/$this->id")->response();
    }


}