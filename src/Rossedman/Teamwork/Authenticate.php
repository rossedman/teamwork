<?php  namespace Rossedman\Teamwork;

class Authenticate extends AbstractObject {

    protected $url = "https://authenticate.teamworkpm.net/authenticate.json";

    /**
     * Authenticate Details
     * GET https://authenticate.teamworkpm.net/authenticate.json
     *
     * @link http://developer.teamwork.com/account#the_'authenti
     * @return mixed
     */
    public function authenticate()
    {
        return $this->client->get($this->url)->response();
    }
}