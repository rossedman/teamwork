<?php  namespace Rossedman\Teamwork;

use GuzzleHttp\Client as Guzzle;
use Rossedman\Teamwork\Contracts\Requestable;

class Client implements Requestable {

    protected $client;

    protected $request;

    protected $key;

    protected $url;

    protected $dataFormat = 'json';

    /**
     * @param Guzzle $client
     */
    public function __construct(Guzzle $client, $key, $url)
    {
        $this->client = $client;
        $this->key = $key;
        $this->url = $url;
    }

    /**
     * @param $endpoint
     *
     * @return Client
     */
    public function get($endpoint, $query = null)
    {
        $this->buildRequest($endpoint, 'GET', [], $query);

        return $this;
    }

    /**
     * @param $endpoint
     * @param $data
     *
     * @return Client
     */
    public function post($endpoint, $data)
    {
        return $this->buildRequest($endpoint, 'POST', ['body' => $data]);
    }

    /**
     * @param $endpoint
     * @param $data
     *
     * @return Client
     */
    public function put($endpoint, $data)
    {
        return $this->buildRequest($endpoint, 'PUT', ['body' => $data]);
    }

    /**
     * @param $endpoint
     *
     * @return Client
     * @internal param $data
     *
     */
    public function delete($endpoint)
    {
        return $this->buildRequest($endpoint, 'DELETE');
    }

    /**
     * @param       $endpoint
     *
     * @param       $action
     * @param array $params
     *
     * @return $this
     */
    public function buildRequest($endpoint, $action, $params = [], $query = null)
    {
        $this->request = $this->client->createRequest($action,
            $this->buildUrl($endpoint), ['auth' => [$this->key, 'X'], $params]
        );

        if($query != null) $this->buildQuery($query);

        return $this;
    }

    /**
     * Send Request
     */
    public function response()
    {
        $this->response = $this->client->send($this->request);

        return $this->response->json();
    }

    /**
     * @param $endpoint
     *
     * @return string
     */
    public function buildUrl($endpoint)
    {
        if(substr($this->url, -1) != '/') {
            $this->url = $this->url . '/';
        }

        return $this->url . $endpoint . '.' . $this->dataFormat;
    }

    /**
     * Build Query String
     *
     * @param $query
     */
    public function buildQuery($query)
    {
        $q = $this->request->getQuery();
        foreach ($query as $key => $value)
        {
            $q[$key] = $value;
        }
    }
}