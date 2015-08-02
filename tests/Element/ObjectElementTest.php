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
use WNowicki\Generic\Element\ObjectElement;

/**
 * Object Element Test
 *
 * @author WN
 * @package Tests\Element
 */
class ObjectElementTest extends \PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf('WNowicki\Generic\Contracts\Element', ObjectElement::make('\stdClass'));
        $this->assertInstanceOf('WNowicki\Generic\Element\ObjectElement', ObjectElement::make('\stdClass'));
    }

    public function testWrongType()
    {
        $this->setExpectedException('WNowicki\Generic\Exceptions\InvalidArgumentException');

        ObjectElement::make('\stdClass', []);
    }

    public function testGetValue()
    {
        $obj = new \stdClass();

        $this->assertSame($obj, ObjectElement::make('\stdClass', $obj)->getValue());
    }

    public function testGetType()
    {
        $this->assertSame('\stdClass', ObjectElement::make('\stdClass')->getType());
    }
}
