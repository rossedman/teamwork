<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Contracts\RequestableInterface;

abstract class AbstractObject {

    /**
     * @var RequestableInterface
     */
    protected $client;

    /**
     * TODO: is this needed?
     */
    protected $request;

    /**
     * @var null|integer
     */
    protected $id;

    /**
     * @param RequestableInterface $client
     * @param null                 $id
     */
    public function __construct(RequestableInterface $client, $id = null)
    {
        $this->client = $client;
        $this->id = $id;
    }

    /**
     * Get ID
     *
     * simple getter for ID
     *
     * @return null
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Are Arguments Valid
     *
     * @param array    $args
     * @param string[] $accepted
     *
     * @return null|bool
     */
    protected function areArgumentsValid($args, array $accepted)
    {
        if ($args == null)
        {
            return;
        }

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