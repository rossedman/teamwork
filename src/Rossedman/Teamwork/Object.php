<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\Contracts\Requestable;

abstract class Object {

    protected $client;

    protected $request;

    protected $id;

    /**
     * @param Requestable $client
     */
    public function __construct(Requestable $client, $id = null)
    {
        $this->client = $client;
        $this->id     = $id;
    }

    /**
     * @return null
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Are Arguments Valid
     *
     * @param array $args
     * @param array $accepted
     *
     * @return bool
     */
    protected function areArgumentsValid($args, array $accepted)
    {
        if ($args == null) return;

        foreach ($accepted as $accept)
        {
            if (array_key_exists($accept, $args)) return true;
        }

        throw new \InvalidArgumentException('This call only accepts these arguments: ' . implode(" | ",$accepted));
    }

}