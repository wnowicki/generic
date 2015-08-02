<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wojciechnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WNowicki\Generic\Element;

/**
 * Generic Element
 *
 * @author WN
 * @package WNowicki\Generic\Element
 */
class GenericElement extends AbstractScalarElement
{
    /**
     * Checks if $value is valid type for Element
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        return true;
    }

    public function getType()
    {
        return self::TYPE_GENERIC;
    }
}