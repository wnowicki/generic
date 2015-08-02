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
use WNowicki\Generic\Element\ArrayElement;

/**
 * Array Element Test
 *
 * @author WN
 * @package Tests\Element
 */
class ArrayElementTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf('WNowicki\Generic\Contracts\Element', ArrayElement::make([]));
        $this->assertInstanceOf('WNowicki\Generic\Element\ArrayElement', ArrayElement::make([]));
    }

    public function testWrongType()
    {
        $this->setExpectedException('WNowicki\Generic\Exceptions\InvalidArgumentException');

        ArrayElement::make('test');
    }

    public function testGetValue()
    {
        $this->assertSame([345], ArrayElement::make([345])->getValue());
    }

    public function testGetType()
    {
        $this->assertSame(Element::TYPE_ARRAY, ArrayElement::make([])->getType());
    }
}
