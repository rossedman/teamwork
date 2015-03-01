<?php  namespace Rossedman\Teamwork; 

class Account extends Object {

    /**
     * Account Details
     * GET /account.json
     *
     * @return mixed
     */
    public function details()
    {
        return $this->client->get('account')->response();
    }

    /**
     * Authenticate Call
     * GET /authenticate.json
     *
     * @return mixed
     */
    public function authenticate()
    {
        return $this->client->get('authenticate')->response();
    }

}