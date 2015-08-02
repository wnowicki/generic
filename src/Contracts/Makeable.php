<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wojciechnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WNowicki\Generic\Contracts;

interface Makeable
{
    /**
     * Make object from array
     *
     * @param array $components
     * @return self
     */
    public static function make(array $components);
}
