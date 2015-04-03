<?php  namespace Rossedman\Teamwork;

class Activity extends AbstractObject {

    /**
     * Latest Activity
     * GET /latestActivity.json
     *
     * @link http://developer.teamwork.com/activity#options
     *
     * @params $args  [ maxItems | onlyStarred ]
     *
     * @return mixed
     */
    public function latest($args = null)
    {
        $this->areArgumentsValid($args, ['maxItems', 'onlyStarred']);

        return $this->client->get('latestActivity', $args)->response();
    }

    /**
     * Delete Activity
     * DELETE /activity/{$id}.json
     *
     * @link http://developer.teamwork.com/activity#delete_an_activit
     *
     * @return mixed
     */
    public function delete()
    {
        return $this->client->delete("activity/$this->id")->response();
    }

}