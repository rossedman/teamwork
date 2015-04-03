<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\TimeTrait;
use Rossedman\Teamwork\Traits\RestfulTrait;

class Project extends AbstractObject {

    use RestfulTrait, TimeTrait;

    protected $wrapper  = 'project';

    protected $endpoint = 'projects';

    /**
     * Get Project Activity
     * GET /projects/{project_id}/activity.json
     *
     * @return  mixed
     */
    public function activity($args = null)
    {
        $this->areArgumentsValid($args, ['maxItems']);

        return $this->client->get("$this->endpoint/$this->id/latestActivity", $args)->response();
    }

    /**
     * Get Companies In Project
     * GET /projects/{project_id}/companies.json
     *
     * @retun mixed
     */
    public function companies()
    {
        return $this->client->get("$this->endpoint/$this->id/companies")->response();
    }

    /**
     * Get People On Project
     * GET /projects/{project_id}/people.json
     *
     * @return mixed
     */
    public function people()
    {
        return $this->client->get("$this->endpoint/$this->id/people")->response();
    }

    /**
     * Get Starred Projects
     * GET /projects/starred.json
     *
     * @return mixed
     */
    public function starred()
    {
        return $this->client->get("$this->endpoint/starred")->response();
    }

    /**
     * Star A Project
     * PUT /projects/{$id}/star.json
     *
     * @return mixed
     */
    public function star()
    {
        return $this->client->put("$this->endpoint/$this->id/star")->response();
    }

    /**
     * Unstar A Project
     * PUT /projects/{$id}/unstar.json
     *
     * @return mixed
     */
    public function unstar()
    {
        return $this->client->put("$this->endpoint/$this->id/unstar")->response();
    }

    /**
     * All Project Links
     * GET /projects/{id}/links.json
     *
     * @return mixed
     */
    public function links()
    {
        return $this->client->get("$this->endpoint/$this->id/links")->response();
    }

    /**
     * Time Totals
     * GET /projects/{id}/time/total.json
     *
     * @return mixed
     */
    public function timeTotal()
    {
        return $this->client->get("$this->endpoint/$this->id/time/total")->response();
    }

    /**
     * Latest Messages
     * GET /projects/{project_id}/posts.json
     *
     * @return mixed
     */
    public function latestMessages()
    {
        return $this->client->get("$this->endpoint/$this->id/posts")->response();
    }

    /**
     * Archived Messages
     * GET /projects/{project_id}/posts/archive.json
     *
     * @return mixed
     */
    public function archivedMessages()
    {
        return $this->client->get("$this->endpoint/$this->id/posts/archive")->response();
    }

    /**
     * List Milestones
     * GET /projects/{project_id}/milestones.json
     *
     * @return mixed
     */
    public function milestones()
    {
        return $this->client->get("$this->endpoint/$this->id/milestones")->response();
    }

}