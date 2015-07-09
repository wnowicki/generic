<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WNowicki\Generic\ApiClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Abstract Api Client
 *
 * @author WN
 * @package WNowicki\Generic\ApiClient
 */
abstract class AbstractApiClient
{
    private $client;

    /**
     * @author WN
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    /**
     * @author WN
     * @param $baseUrl
     * @return static
     */
    public static function make($baseUrl)
    {
        return new static(
            [
                'base_uri' => $baseUrl
            ]
        );
    }

    /**
     * @author WN
     * @param $uri
     * @param array $query
     * @return array
     * @throws ErrorResponseException
     * @throws \Exception
     */
    public function get($uri, array $query = [])
    {
        return $this->send((new Request('GET', $uri)), [], $query);
    }

    /**
     * @author WN
     * @param $uri
     * @param array $body
     * @param array $query
     * @return array
     * @throws ErrorResponseException
     * @throws \Exception
     */
    public function post($uri, array $body = [], array $query = [])
    {
        return $this->send((new Request('POST', $uri)), $body, $query);
    }

    /**
     * @author WN
     * @param $uri
     * @param array $body
     * @param array $query
     * @return array
     * @throws ErrorResponseException
     * @throws \Exception
     */
    public function put($uri, array $body = [], array $query = [])
    {
        return $this->send((new Request('PUT', $uri)), $body, $query);
    }

    /**
     * @author WN
     * @param $uri
     * @param array $body
     * @param array $query
     * @return array
     * @throws ErrorResponseException
     * @throws \Exception
     */
    public function patch($uri, array $body = [], array $query = [])
    {
        return $this->send((new Request('PATCH', $uri)), $body, $query);
    }

    /**
     * @author WN
     * @param $uri
     * @param array $query
     * @return array
     * @throws ErrorResponseException
     * @throws \Exception
     */
    public function delete($uri, array $query = [])
    {
        return $this->send((new Request('DELETE', $uri)), [], $query);
    }

    /**
     * @author WN
     * @param RequestInterface $request
     * @param array $body
     * @param array $query
     * @return array
     * @throws ErrorResponseException
     * @throws \Exception
     */
    private function send(RequestInterface $request, array $body = [], array $query = [])
    {
        $options = [];

        if (count($body) > 0) {
            $options = $this->processRequestBody($body);
        }

        if (count($query) > 0) {
            $options['query'] = $query;
        }

        try {

            $response = $this->client->send($request, $options);

            return $this->processResponse($response);

        } catch (ClientException $e) {

            $this->processErrorResponse($e->getResponse());

            throw $e;
        }
    }

    /**
     * @author WN
     * @param array $body
     * @return array
     */
    protected abstract function processRequestBody(array $body);

    /**
     * @author WN
     * @param ResponseInterface $response
     * @return array
     * @throws BadResponseException
     */
    protected abstract function processResponse(ResponseInterface $response);

    /**
     * @author WN
     * @param ResponseInterface $response
     * @throws ErrorResponseException
     */
    protected abstract function processErrorResponse(ResponseInterface $response);
}
