<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wojciechnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WNowicki\Generic\ApiClient;

/**
 * Bad Response Exception
 *
 * Response was received from server but message is not readable.
 *
 * @author WN
 * @package WNowicki\Generic\ApiClient
 */
class WrongResponseException extends ApiClientException
{
}
