<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\Traits\RestfulTrait;

class People extends AbstractObject {

    use RestfulTrait;

    protected $wrapper  = 'person';

    protected $endpoint = 'people';

    /**
     * GET /people.json
     *
     * @return mixed
     */
    public function all($args = null)
    {
        $this->areArgumentsValid($args, ['page', 'pageSize', 'emailaddress']);

        return $this->client->get($this->endpoint, $args)->response();
    }

    /**
     * GET /me.json
     */
    public function me()
    {
        return $this->client->get("me")->response();
    }

    /**
     * Get All API Keys
     * GET /people/APIKeys.json
     *
     * @return mixed
     */
    public function apiKeys()
    {
        return $this->client->get("$this->endpoint/APIKeys")->response();
    }

}