<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WNowicki\Generic\Contracts;

/**
 * Jsonable Interface
 *
 * @author WN
 * @package WNowicki\Generic\Contracts
 */
interface Jsonable
{
    /**
     * JSON representation of an object
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0);
}
