<?php namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Exceptions\ClassNotCreatedException;

use GuzzleHttp\Client as Guzzle;

class Factory {

    /**
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * @var
     */
    protected $request;

    /**
     * @param Guzzle $guzzle
     * @param        $key
     */
    public function __construct(Guzzle $guzzle, $key)
    {
        $this->guzzle   = $guzzle;
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

        return new $class($this->guzzle, $this->key);
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
