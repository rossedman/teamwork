<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\AbstractObject;
use Rossedman\Teamwork\Traits\RestfulTrait;

class CalendarEvent extends AbstractObject {

    use RestfulTrait;

    protected $wrapper  = 'event';
    
    protected $endpoint = 'calendarevents';

    /**
     * GET /calendareventtypes.json
     */
    public function eventTypes()
    {
        return $this->client->get("calendareventtypes")->response();
    }

}
