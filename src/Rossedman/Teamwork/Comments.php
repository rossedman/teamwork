<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\RestfulTrait;

class Comments extends AbstractObject {

    use RestfulTrait;

    protected $wrapper  = 'comment';

    protected $endpoint = 'comments';

    /**
     * Create Message
     * POST /$resource/$id/comments.json
     *
     * @retun mixed
     */
    public function create($resource, $resouce_id, $data)
    {
        return $this->client->post("$resource/$resouce_id/comments", [$this->wrapper => $data])->response();
    }
}