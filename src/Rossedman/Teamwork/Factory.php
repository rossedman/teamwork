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
        $class = $this->getQualifiedName($method);

        $this->doesClassExist($class);

        if($this->paramIsId($parameters) == true)
        {
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

    /**
     * Get Fully Qualified Name
     *
     * build and return fully qualified name
     * for class to instantiate
     *
     * @param $method
     *
     * @return string
     */
    protected function getQualifiedName($method)
    {
        return $this->getNamespace().'\\'.ucfirst($method);
    }

    /**
     * Parameter Has ID
     *
     * is there a parameter being passed in, and is it
     * an integer?
     *
     * @param $parameters
     *
     * @return bool
     */
    protected function paramIsId($parameters)
    {
        if($parameters == null) return null;

        if ( ! is_int($parameters[0]))
        {
            throw new \InvalidArgumentException("This is not a valid ID");
        }

        return true;
    }

    /**
     * @param $class
     *
     * @throws ClassNotCreatedException
     */
    protected function doesClassExist($class)
    {
        if ( ! class_exists($class))
        {
            throw new ClassNotCreatedException("Class $class could not be created.");
        }
    }
}
