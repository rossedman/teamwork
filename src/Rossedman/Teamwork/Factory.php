<?php namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Contracts\Requestable;
use Rossedman\Teamwork\Exceptions\ClassNotCreatedException;

class Factory {

    protected $client;

    /**
     * @param Requestable $client
     * @param                    $key
     */
    public function __construct(Requestable $client, $key)
    {
        $this->client   = $client;
        $this->key      = $key;
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

        return new $class($this->client, $this->key);
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
