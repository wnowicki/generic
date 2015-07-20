<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\ApiClient;

use WNowicki\Generic\ApiClient\ApiClient;

/**
 * Abstract Api Client Test
 *
 * @author WN
 * @package Tests\ApiClient
 */
class AbstractApiClientTest extends \PHPUnit_Framework_TestCase
{
    public function testBadResponse()
    {
        $api = ApiClient::make('http://httpbin.org/status/418');

        $this->setExpectedException('GuzzleHttp\Exception\ClientException');

        $api->get('');
    }

    public function testWrongResponse()
    {
        $api = ApiClient::make('http://httpbin.org/xml');

        $this->setExpectedException('WNowicki\Generic\ApiClient\WrongResponseException');

        $api->get('');
    }

    public function testBadRequest()
    {
        $api = ApiClient::make('htctp://httpbin.org/xml');

        $this->setExpectedException('GuzzleHttp\Exception\RequestException');

        $api->get('');
    }
}
