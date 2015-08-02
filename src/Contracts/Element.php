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
 * Element Interface
 *
 * @author WN
 * @package WNowicki\Generic\Contracts
 */
interface Element
{
    const TYPE_GENERIC = 0;
    const TYPE_ARRAY = 1;
    const TYPE_BOOL = 2;
    const TYPE_INT = 4;
    const TYPE_STRING = 8;
    const TYPE_FLOAT = 16;

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * Checks if $value is valid type for Element
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value);

    /**
     * @return int|string
     */
    public function getType();
}
