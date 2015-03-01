<?php  namespace Rossedman\Teamwork; 

use Rossedman\Teamwork\Contracts\Requestable;

abstract class Object {

    protected $client;

    protected $request;

    public function __construct(Requestable $client)
    {
        $this->client = $client;
    }

    /**
     * Are Argument Valid
     *
     * @param array $args
     * @param array $accepted
     *
     * @return bool
     */
    protected function areArgumentsValid(array $args, array $accepted)
    {
        if ($args != null)
        {
            foreach ($accepted as $accept)
            {
                if (array_key_exists($accept, $args))
                {
                    return true;
                }
            }

            throw new \InvalidArgumentException('This call only accepts these arguments: ' . implode(" | ",$accepted));
        }
    }

}