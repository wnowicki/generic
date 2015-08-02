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
use WNowicki\Generic\Exceptions\InvalidArgumentException;

/**
 * Abstract Element
 *
 * @author WN
 * @package WNowicki\Generic\Element
 */
abstract class AbstractElement implements Element
{
    private $value;

    /**
     * @param mixed $value
     * @return $this
     * @throws InvalidArgumentException
     */
    public function set($value)
    {
        if ($this->isValid($value)) {

            $this->value = $value;
            return $this;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->value;
    }
}
