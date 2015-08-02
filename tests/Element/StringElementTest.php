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
use WNowicki\Generic\Element\StringElement;

/**
 * String Element Test
 *
 * @author WN
 * @package Tests\Element
 */
class StringElementTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf('WNowicki\Generic\Contracts\Element', StringElement::make('aaa'));
        $this->assertInstanceOf('WNowicki\Generic\Element\StringElement', StringElement::make(''));
    }

    public function testWrongType()
    {
        $this->setExpectedException('WNowicki\Generic\Exceptions\InvalidArgumentException');

        StringElement::make(45);
    }

    public function testGetValue()
    {
        $this->assertSame('er', StringElement::make('er')->getValue());
        $this->assertSame('3', StringElement::make('3')->getValue());
    }

    public function testGetType()
    {
        $this->assertSame(Element::TYPE_STRING, StringElement::make('wr')->getType());
    }
}
