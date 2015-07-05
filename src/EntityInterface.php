<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WNowicki\Generic;

/**
 * Entity Interface
 *
 * @author  WN
 * @package WNowicki\Generic
 */
interface EntityInterface
{
    /**
     * To Array
     *
     * Return flatten (arrays of scalars (+ null)???) representation of Entity
     *
     * @return array
     */
    public function toArray();
}
