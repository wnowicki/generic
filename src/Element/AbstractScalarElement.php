<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WNowicki\Generic\Element;

/**
 * IntElement
 *
 * @author WN
 * @package WNowicki\Generic\Element
 */
abstract class AbstractScalarElement extends AbstractElement
{
    /**
     * @param int|string|float|bool $value
     * @return static
     * @throws \WNowicki\Generic\Exceptions\InvalidArgumentException
     */
    public static function make($value)
    {
        return (new static())->set($value);
    }
}
