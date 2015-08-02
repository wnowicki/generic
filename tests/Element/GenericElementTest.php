<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\Element;

use WNowicki\Generic\Contracts\Element;
use WNowicki\Generic\Element\GenericElement;

/**
 * Generic Element Test
 *
 * @author WN
 * @package Tests\Element
 */
class GenericElementTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf('WNowicki\Generic\Contracts\Element', GenericElement::make(1));
        $this->assertInstanceOf('WNowicki\Generic\Element\GenericElement', GenericElement::make('43545'));
    }

    public function testGetValue()
    {
        $this->assertSame(345, GenericElement::make(345)->getValue());
    }

    public function testGetType()
    {
        $this->assertSame(Element::TYPE_GENERIC, GenericElement::make(1)->getType());
    }
}
