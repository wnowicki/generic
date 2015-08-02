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
use WNowicki\Generic\Element\ElementFactory;

/**
 * Element Factory Test
 *
 * @author WN
 * @package Tests\Element
 */
class ElementFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testMakeArray()
    {
        $this->assertInstanceOf('WNowicki\Generic\Element\ArrayElement', ElementFactory::make(Element::TYPE_ARRAY, []));
    }

    public function testMakeInt()
    {
        $this->assertInstanceOf('WNowicki\Generic\Element\IntElement', ElementFactory::make(Element::TYPE_INT, 5));
    }

    public function testMakeFloat()
    {
        $this->assertInstanceOf(
            'WNowicki\Generic\Element\FloatElement',
            ElementFactory::make(Element::TYPE_FLOAT, 5.5)
        );
    }

    public function testMakeBool()
    {
        $this->assertInstanceOf('WNowicki\Generic\Element\BoolElement', ElementFactory::make(Element::TYPE_BOOL, true));
    }

    public function testMakeObject()
    {
        $this->assertInstanceOf('WNowicki\Generic\Element\ObjectElement', ElementFactory::make('\stdClass', null));
    }
}
