<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\RestfulTrait;

class Message extends AbstractObject {

    use RestfulTrait;

    protected $wrapper  = 'post';

    protected $endpoint = 'posts';

    /**
     * Create Message
     * POST /projects/{project_id}/posts.json
     *
     * The RestfulTrait must be overwritten because messages
     * require a project to be associated with.
     *
     * $teamwork->message($projectID)->create([$data]);
     *
     * @retun mixed
     */
    public function create($data)
    {
        return $this->client->post("projects/$this->id/posts", [$this->wrapper => $data])->response();
    }

    /**
     * Archive Message
     * PUT /messages/{id}/archive.json
     */
    public function archive()
    {
        return $this->client->put("messages/$this->id/archive")->response();
    }

    /**
     * Unarchive Message
     * PUT /messages/{id}/unarchive.json
     */
    public function unarchive()
    {
        return $this->client->put("messages/$this->id/unarchive")->response();
    }

}