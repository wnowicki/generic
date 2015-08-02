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

use WNowicki\Generic\Contracts\Element;

/**
 * Element Factory
 *
 * @author WN
 * @package WNowicki\Generic\Element
 */
class ElementFactory
{
    /**
     * @author WN
     * @param $type
     * @param $value
     * @return Element
     */
    public static function make($type, $value)
    {
        if (is_numeric($type)) {

            return self::makeInternalType($type, $value);
        }

        return ObjectElement::make($type, $value);
    }

    /**
     * @param $type
     * @param $value
     * @return Element
     */
    private static function makeInternalType($type, $value)
    {
        if ($type == Element::TYPE_ARRAY) {

            return ArrayElement::make($value);
        }
        return self::makeScalar($type, $value);
    }

    /**
     * @param $type
     * @param $value
     * @return Element
     */
    private static function makeScalar($type, $value)
    {
        if ($type == Element::TYPE_INT) {
            return IntElement::make($value);
        } elseif ($type == Element::TYPE_FLOAT) {
            return FloatElement::make($value);
        } elseif ($type == Element::TYPE_BOOL) {
            return BoolElement::make($value);
        } else ($type == Element::TYPE_STRING) {
            return StringElement::make($value);
        }
    }
}
