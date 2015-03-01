<?php  namespace Rossedman\Teamwork;

class Activity extends Object {

    /**
     * Latest Activity
     * GET /latestActivity.json
     *
     * @return mixed
     */
    public function latest($args = null)
    {
        $this->areArgumentsValid($args, ['maxItems', 'onlyStarred']);

        return $this->client->get('latestActivity', $args)->response();
    }
}