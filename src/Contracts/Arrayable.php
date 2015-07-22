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
 * Arrayable Interface
 *
 * @author WN
 * @package WNowicki\Generic\Contracts
 */
interface Arrayable
{
    /**
     * To Array
     *
     * An array representation of object
     *
     * @param bool $recursively If set to `true` then toArray(true) will be called on each `Arrayable` property
     * @return array
     */
    public function toArray($recursively = false);
}
