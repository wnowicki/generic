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
use WNowicki\Generic\Element\FloatElement;
use WNowicki\Generic\Element\IntElement;

/**
 * Float Element Test
 *
 * @author WN
 * @package Tests\Element
 */
class FloatElementTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf('WNowicki\Generic\Contracts\Element', FloatElement::make(1.1));
        $this->assertInstanceOf('WNowicki\Generic\Element\FloatElement', FloatElement::make(1.1));
    }

    public function testWrongType()
    {
        $this->setExpectedException('WNowicki\Generic\Exceptions\InvalidArgumentException');

        FloatElement::make('test');
    }

    public function testGetValue()
    {
        $this->assertSame(345.6, FloatElement::make(345.6)->getValue());
    }

    public function testGetType()
    {
        $this->assertSame(Element::TYPE_FLOAT, FloatElement::make(1.0)->getType());
    }
}
