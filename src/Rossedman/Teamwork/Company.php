<?php  namespace Rossedman\Teamwork; 

class Company extends Object {

    protected $wrapper = 'company';

    protected $endpoint = 'companies';

    /**
     * Get All Companies
     * GET /companies.json
     *
     * @link http://developer.teamwork.com/companies#retrieve_companie
     *
     * @return mixed
     */
    public function all()
    {
        return $this->client->get($this->endpoint)->response();
    }

    /**
     * Find Company
     * GET /companies/{company_id}.json
     *
     * @link http://developer.teamwork.com/companies#retrieve_a_single
     *
     * @return mixed
     */
    public function find()
    {
        return $this->client->get("$this->endpoint/$this->id")->response();
    }

    /**
     * Create Company
     * POST /companies.json
     *
     * @link http://developer.teamwork.com/companies#create_company
     *
     * @param $data
     *
     * @return array | companyID
     */
    public function create($data)
    {
        return $this->client->post("$this->endpoint", [$this->wrapper => $data])->response();
    }

    /**
     * Update Company
     * PUT /companies/{company_id}.json
     *
     * @link http://developer.teamwork.com/companies#update_company
     *
     * @param $data
     *
     * @return mixed
     */
    public function update($data)
    {
        return $this->client->put("$this->endpoint/$this->id", [$this->wrapper => $data])->response();
    }

    /**
     * Delete A Company
     * DELETE /companies/{company_id}.json
     *
     * @return mixed
     */
    public function delete()
    {
        return $this->client->delete("$this->endpoint/$this->id")->response();
    }

    /**
     * Get People Associated With Company
     * GET /companies/{company_id}/people.json
     *
     * @link http://developer.teamwork.com/people#get_people_(withi
     *
     * @return mixed
     */
    public function people()
    {
        return $this->client->get("$this->endpoint/$this->id/people")->response();
    }

}