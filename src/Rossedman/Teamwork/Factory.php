<?php namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Contracts\Requestable;
use Rossedman\Teamwork\Exceptions\ClassNotCreatedException;

class Factory {

    protected $client;

    /**
     * @param Requestable $client
     */
    public function __construct(Requestable $client)
    {
        $this->client   = $client;
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
        $class = $this->getNamespace() . '\\' . strtoupper($method);

        if( ! class_exists($class))
        {
            throw new ClassNotCreatedException('Class $class could not be created.');
        }

        // TODO write parameters checks and parse
        // TODO eventually parse to search by name?

        return new $class($this->client, $parameters[0]);
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
