<?php namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Contracts\RequestableInterface;
use Rossedman\Teamwork\Exceptions\ClassNotCreatedException;

class Factory {

    protected $client;

    /**
     * @param RequestableInterface $client
     */
    public function __construct(RequestableInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $method
     * @param $parameters
     *
     * @return mixed
     * @throws ClassNotCreatedException
     */
    public function __call($method, $parameters)
    {
        $class = $this->getNamespace().'\\'.strtoupper($method);

        if ( ! class_exists($class))
        {
            throw new ClassNotCreatedException('Class $class could not be created.');
        }

        // only accepts id
        if ($parameters != null)
        {
            if ( ! is_int($parameters[0])) {
                throw new \InvalidArgumentException('This is not a valid ID');
            }

            return new $class($this->client, $parameters[0]);
        }

        return new $class($this->client);
    }

    /**
     * Get Namespace
     *
     * @return mixed
     */
    private function getNamespace()
    {
        $reflection = new \ReflectionClass($this);

        return $reflection->getNamespaceName();
    }

}
