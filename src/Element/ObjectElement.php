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

use WNowicki\Generic\Exception;

/**
 * Object Element
 *
 * @author WN
 * @package WNowicki\Generic\Element
 */
class ObjectElement extends AbstractElement
{
    private $type;

    /**
     * @param $type
     * @throws Exception
     */
    public function __construct($type)
    {
        if (!class_exists($type)) {
            throw new Exception('Class ' . $type . ' not exists');
        }

        $this->type = $type;
    }

    /**
     * @param  $type
     * @param mixed $value
     * @return ObjectElement
     * @throws \WNowicki\Generic\Exceptions\InvalidArgumentException
     */
    public static function make($type, $value = null)
    {
        $element = new self($type);

        if ($value !== null) {
            $element->setValue($value);
        }

        return $element;
    }

    /**
     * Checks if $value is valid type for Element
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        return is_a($value, $this->getType());
    }

    /**
     * @return int|string
     */
    public function getType()
    {
        return $this->type;
    }
}
