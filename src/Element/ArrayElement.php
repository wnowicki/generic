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
 * Array Element
 *
 * @author WN
 * @package WNowicki\Generic\Element
 */
class ArrayElement extends AbstractElement
{
    /**
     * @param array $value
     * @return $this
     * @throws \WNowicki\Generic\Exceptions\InvalidArgumentException
     */
    public static function make($value)
    {
        return (new self())->setValue($value);
    }

    /**
     * Checks if $value is valid type for Element
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        return is_array($value);
    }

    public function getType()
    {
        return self::TYPE_ARRAY;
    }
}
