<?php  namespace Rossedman\Teamwork; 

class Company extends Object {

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
        return $this->client->get('companies')->response();
    }

    /**
     * Find Company
     * GET /companies/{company_id}.json
     *
     * @param $id
     *
     * @link http://developer.teamwork.com/companies#retrieve_a_single
     *
     * @return mixed
     */
    public function find($id)
    {
        $this->isValidId($id);

        return $this->client->get("companies/$id")->response();
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
        return $this->client->post("companies", ['company' => $data])->response();
    }

    /**
     * Update Company
     * PUT /companies/{company_id}.json
     *
     * @link http://developer.teamwork.com/companies#update_company
     *
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->client->put("companies/$id", ['company' => $data])->response();
    }

    /**
     * Delete A Company
     * DELETE /companies/{company_id}.json
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->client->delete("companies/$id")->response();
    }
    
}