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
 * Bool Element
 *
 * @author WN
 * @package WNowicki\Generic\Element
 */
class BoolElement extends AbstractScalarElement
{
    /**
     * Checks if $value is valid type for Element
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        return is_bool($value);
    }

    public function getType()
    {
        return self::TYPE_BOOL;
    }
}
