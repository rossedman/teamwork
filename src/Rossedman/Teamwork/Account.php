<?php  namespace Rossedman\Teamwork; 

class Account extends Object {

    public function details()
    {
        return $this->client->get('account')->response();
    }

    public function authenticate()
    {
        return $this->client->get('authenticate')->response();
    }

}