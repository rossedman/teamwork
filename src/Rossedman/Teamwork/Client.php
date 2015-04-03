<?php  namespace Rossedman\Teamwork;

use GuzzleHttp\Client as Guzzle;
use Rossedman\Teamwork\Contracts\Requestable;

class Client implements Requestable {

    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var GuzzleHttp\Request
     */
    protected $request;

    /**
     * API Key
     *
     * The custom API key provided by Teamwork
     *
     * @var string
     */
    protected $key;

    /**
     * URL
     *
     * The URL that is set to query the Teamwork API.
     * This is the account URL used to access the project
     * management system. This is passed in on construct.
     *
     * @var string
     */
    protected $url;

    /**
     * Currently this package doesn't support XML
     * but overtime this would be part of that support
     *
     * @var string
     */
    protected $dataFormat = 'json';

    /**
     * @param Guzzle $client
     * @param        $key
     * @param        $url
     */
    public function __construct(Guzzle $client, $key, $url)
    {
        $this->client = $client;
        $this->key = $key;
        $this->url = $url;
    }

    /**
     * Get
     *
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
     * Post
     *
     * @param $endpoint
     * @param $data
     *
     * @return Client
     */
    public function post($endpoint, $data)
    {
        return $this->buildRequest($endpoint, 'POST', $data);
    }

    /**
     * Put
     *
     * @param $endpoint
     * @param $data
     *
     * @return Client
     */
    public function put($endpoint, $data)
    {
        return $this->buildRequest($endpoint, 'PUT', $data);
    }

    /**
     * Delete
     *
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
     * Build Request
     *
     * build up request including authentication, body,
     * and string queries if necessary. This is where the bulk
     * of the data is build up to connect to Teamwork with.
     *
     * @param       $endpoint
     * @param       $action
     * @param array $params
     *
     * @return $this
     */
    public function buildRequest($endpoint, $action, $params = [], $query = null)
    {
        if (count($params) > 0)
        {
            $params = json_encode($params);
        }

        $this->request = $this->client->createRequest($action,
            $this->buildUrl($endpoint), ['auth' => [$this->key, 'X'], 'body' => $params]
        );

        if ($query != null)
        {
            $this->buildQuery($query);
        }

        return $this;
    }

    /**
     * Response
     *
     * this send the request from the built response and
     * returns the response as a JSON payload
     */
    public function response()
    {
        $this->response = $this->client->send($this->request);

        return $this->response->json();
    }

    /**
     * Build Url
     *
     * builds the url to make the request to Teamwork with
     * and passes it into Guzzle. Also checks if trailing slash
     * is present.
     *
     * @param $endpoint
     *
     * @return string
     */
    public function buildUrl($endpoint)
    {
        if (substr($this->url, -1) != '/')
        {
            $this->url = $this->url . '/';
        }

        return $this->url . $endpoint . '.' . $this->dataFormat;
    }

    /**
     * Build Query String
     *
     * if a query string is needed it will be built up
     * and added to the request. This is only used in certain
     * GET requests
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

    /**
     * Get Request
     *
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }
}