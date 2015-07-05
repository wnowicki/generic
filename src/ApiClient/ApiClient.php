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

use Psr\Http\Message\ResponseInterface;

/**
 * Api Client
 *
 * @author WN
 * @package WNowicki\Generic\ApiClient
 */
class ApiClient extends AbstractApiClient
{
    /**
     * @author WN
     * @param array $body
     * @return array
     */
    protected function processRequestBody(array $body)
    {
        return ['json' => $body];
    }

    /**
     * @author WN
     * @param ResponseInterface $response
     * @return array
     * @throws BadResponseException
     */
    protected function processResponse(ResponseInterface $response)
    {
        if ($responseBody = json_decode($response->getBody()->getContents(), true)) {

            return $responseBody;
        }

        throw new BadResponseException('Response body was malformed JSON', $response->getStatusCode());
    }

    /**
     * @author WN
     * @param ResponseInterface $response
     * @throws ErrorResponseException
     */
    protected function processErrorResponse(ResponseInterface $response)
    {
        if (($responseBody = json_decode($response->getBody()->getContents(), true)) &&
            array_key_exists('message', $responseBody)
        ) {

            throw new ErrorResponseException($responseBody['message'], $response->getStatusCode());
        }
    }
}
