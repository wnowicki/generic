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
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use WNowicki\Generic\Logger\PsrLoggerTrait;

/**
 * Abstract Api Client
 *
 * @author WN
 * @package WNowicki\Generic\ApiClient
 */
abstract class AbstractApiClient
{
    use PsrLoggerTrait;

    private $client;
    private $logger;

    /**
     * @author WN
     * @param array $config
     * @param LoggerInterface $logger
     */
    public function __construct(array $config = [], LoggerInterface $logger = null)
    {
        $this->client = new Client($config);
        $this->logger = $logger;
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

        } catch (BadResponseException $e) {

            $this->logError(
                'Api Bad Response from [' . $request->getUri() . '] Failed[' . $e->getResponse()->getStatusCode() . ']',
                [
                    'message' => $e->getMessage(),
                    'request' => [
                        'headers'   => $e->getRequest()->getHeaders(),
                        'body'      => $e->getRequest()->getBody()->getContents(),
                        'method'    => $e->getRequest()->getMethod(),
                        'uri'       => $e->getRequest()->getUri(),
                    ],
                    'response' => [
                        'body'      => ($e->getResponse())?$e->getResponse()->getBody()->getContents():'[EMPTY]',
                        'headers'   => ($e->getResponse())?$e->getResponse()->getHeaders():'[EMPTY]',
                    ],
                ]
            );

            throw $e;

        } catch (RequestException $e) {

            $this->logError(
                'Api problem with request to [' . $request->getUri() . ']',
                [
                    'message' => $e->getMessage(),
                    'request' => [
                        'headers'   => $e->getRequest()->getHeaders(),
                        'body'      => $e->getRequest()->getBody()->getContents(),
                        'method'    => $e->getRequest()->getMethod(),
                        'uri'       => $e->getRequest()->getUri(),
                    ],
                ]
            );

            throw $e;
        }
    }

    /**
     * @return \Psr\Log\LoggerInterface|null
     */
    protected function getLogger()
    {
        return $this->logger;
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
