<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Tests;

use WNowicki\Generic\AbstractEntity;

/**
 * Abstract Entity Test
 *
 * @author WN
 * @package Tests
 */
class AbstractEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('WNowicki\Generic\AbstractEntity', $entity);
        $this->assertInstanceOf('WNowicki\Generic\EntityInterface', $entity);
    }

    public function testMake()
    {
        $this->assertInstanceOf('WNowicki\Generic\AbstractEntity', DummyEntity::make([]));
        $this->assertInstanceOf('WNowicki\Generic\EntityInterface', DummyEntity::make([]));
    }

    public function testToArray()
    {
        $this->assertInternalType('array', DummyEntity::make([])->toArray());
    }

    public function testSetId()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setTestField(2));
    }

    public function testGetId()
    {
        $entity = new DummyEntity();

        $entity->setTestField(2);

        $this->assertSame(2, $entity->getTestField());
    }
}

class DummyEntity extends AbstractEntity
{
    protected $properties = [
        'field',
        'test_field',
    ];
}
