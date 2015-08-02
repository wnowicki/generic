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
use WNowicki\Generic\Element\BoolElement;

/**
 * Bool Element Test
 *
 * @author WN
 * @package Tests\Element
 */
class BoolElementTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf('WNowicki\Generic\Contracts\Element', BoolElement::make(true));
        $this->assertInstanceOf('WNowicki\Generic\Element\BoolElement', BoolElement::make(false));
    }

    public function testWrongType()
    {
        $this->setExpectedException('WNowicki\Generic\Exceptions\InvalidArgumentException');

        BoolElement::make('test');
    }

    public function testGetValue()
    {
        $this->assertSame(true, BoolElement::make(true)->getValue());
    }

    public function testGetType()
    {
        $this->assertSame(Element::TYPE_BOOL, BoolElement::make(false)->getType());
    }
}
