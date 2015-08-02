<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wojciechnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests\Element;

use WNowicki\Generic\Contracts\Element;
use WNowicki\Generic\Element\IntElement;

/**
 * Int Element Test
 *
 * @author WN
 * @package Tests\Element
 */
class IntElementTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf('WNowicki\Generic\Contracts\Element', IntElement::make(1));
        $this->assertInstanceOf('WNowicki\Generic\Element\IntElement', IntElement::make(1));
    }

    public function testWrongType()
    {
        $this->setExpectedException('WNowicki\Generic\Exceptions\InvalidArgumentException');

        IntElement::make('test');
    }

    public function testGetValue()
    {
        $this->assertSame(345, IntElement::make(345)->getValue());
    }

    public function testGetType()
    {
        $this->assertSame(Element::TYPE_INT, IntElement::make(1)->getType());
    }
}
