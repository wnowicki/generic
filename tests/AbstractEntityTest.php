<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wojciechnowicki.com>
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
        $this->assertInstanceOf('WNowicki\Generic\Contracts\Entity', $entity);
    }

    public function testMake()
    {
        $this->assertInstanceOf('WNowicki\Generic\AbstractEntity', DummyEntity::make([]));
        $this->assertInstanceOf('WNowicki\Generic\Contracts\Entity', DummyEntity::make([]));
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

    public function testGetNull()
    {
        $entity = new DummyEntity();

        $this->assertNull($entity->getTestField());
    }

    public function testToString()
    {
        $entity = new DummyEntity();

        $this->assertInternalType('string', '' . $entity);
    }

    public function testToStringIsJSON()
    {
        $entity = new DummyEntity();

        $this->assertStringStartsWith('[', '' . $entity);
        $this->assertStringEndsWith(']', '' . $entity);

        $entity->setField('xde');

        $this->assertStringStartsWith('{', '' . $entity);
        $this->assertStringEndsWith('}', '' . $entity);
    }

    public function testToArrayData()
    {
        $entity = DummyEntity::make([
            'test_field' => 2,
            'field'      => DummyEntity::make([]),
        ]);

        $this->assertInternalType('array', $entity->toArray());
        $this->assertArrayHasKey('field', $entity->toArray());
        $this->assertArrayHasKey('test_field', $entity->toArray());
        $this->assertInternalType('array', $entity->toArray(true)['field']);
        $this->assertInternalType('int', $entity->toArray()['test_field']);
    }

    public function testSetNonExistingProperty()
    {
        set_error_handler([$this, 'entityErrorHandler']);

        $this->setExpectedException(
            '\Exception',
            'Call to undefined method WNowicki\Generic\AbstractEntity::setNonExisting()'
        );

        $entity = new DummyEntity();
        $entity->setNonExisting();

        restore_error_handler();
    }

    public function testMissingArgumentOnSet()
    {
        set_error_handler([$this, 'entityErrorHandler']);

        $this->setExpectedException(
            '\Exception',
            'Missing argument on method WNowicki\Generic\AbstractEntity::set_field() call'
        );

        $entity = new DummyEntity();
        $entity->setField();

        restore_error_handler();
    }

    public function testGetNonExistingProperty()
    {
        set_error_handler([$this, 'entityErrorHandler']);

        $this->setExpectedException(
            '\Exception',
            'Call to undefined method WNowicki\Generic\AbstractEntity::getNonExisting()'
        );

        $entity = new DummyEntity();
        $entity->getNonExisting();

        restore_error_handler();
    }

    function entityErrorHandler($errno, $errstr, $errfile, $errline)
    {
        throw new \Exception($errstr);
    }

    public function testIntProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setTwo(2));
    }

    public function testInvalidIntProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'WNowicki\Generic\Exceptions\InvalidArgumentException',
            'Expected value to be type of [int] type [string] was given'
        );

        $entity->setTwo('str');
    }

    public function testGetIntProperty()
    {
        $entity = new DummyEntity();
        $entity->setTwo(0);

        $this->assertSame(0, $entity->getTwo());
    }

    public function testStringProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setThree('str'));
    }

    public function testGetStringProperty()
    {
        $entity = new DummyEntity();
        $entity->setThree('str');

        $this->assertSame('str', $entity->getThree());
    }

    public function testInvalidStringProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'WNowicki\Generic\Exceptions\InvalidArgumentException');

        $entity->setThree(1);
    }

    public function testBoolProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setFour(true));
    }

    public function testInvalidBoolProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'WNowicki\Generic\Exceptions\InvalidArgumentException');

        $entity->setFour('true');
    }

    public function testGetBoolProperty()
    {
        $entity = new DummyEntity();
        $entity->setFour(true);

        $this->assertSame(true, $entity->getFour());
    }

    public function testFloatProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setFive(5.5));
    }

    public function testInvalidFloatProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException(
            'WNowicki\Generic\Exceptions\InvalidArgumentException');

        $entity->setFive('true');
    }

    public function testGetFloatProperty()
    {
        $entity = new DummyEntity();
        $entity->setFive(5.5);

        $this->assertSame(5.5, $entity->getFive());
    }

    public function testArrayProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setOne([]));
    }

    public function testInvalidArrayProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException('WNowicki\Generic\Exceptions\InvalidArgumentException');

        $entity->setOne('str');
    }

    public function testGetArrayProperty()
    {
        $entity = new DummyEntity();
        $entity->setOne([]);

        $this->assertSame([], $entity->getOne());
    }

    public function testSetGetNull()
    {
        $entity = DummyEntity::make([]);

        $this->assertNull($entity->getOne());

        $entity->setFour(null);

        $this->assertNull($entity->getFour());
    }

    public function testObjectProperty()
    {
        $entity = new DummyEntity();

        $this->assertInstanceOf('Tests\DummyEntity', $entity->setObj($entity));
    }

    public function testInvalidObjectProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException('WNowicki\Generic\Exceptions\InvalidArgumentException');

        $entity->setObj('str');
    }

    public function testNonExistingClassProperty()
    {
        $entity = new DummyEntity();

        $this->setExpectedException('WNowicki\Generic\Exception');

        $entity->setObjTwo($entity);
    }

    public function testMakeMakableProperty()
    {
        $entity = DummyEntity::make([
            'obj' => [
                'field' => 'xxxxx',
                'one'   => [],
            ]
        ]);

        $this->assertInstanceOf('WNowicki\Generic\AbstractEntity', $entity->getObj());
    }
}

/**
 * @method $this setOne(array $one)
 * @method array|null getOne()
 * @method $this setTwo(int $two)
 * @method int|null getTwo()
 * @method $this setThree(string $three)
 * @method string|null getThree()
 * @method $this setFour(bool $four)
 * @method bool|null getFour()
 * @method $this setFive(float $five)
 * @method float|null getFive()
 * @method $this setObj(DummyEntity $obj)
 * @method DummyEntity|null getObj()
 */
class DummyEntity extends AbstractEntity
{
    protected $properties = [
        'field',
        'test_field',
        'one' => self::TYPE_ARRAY,
        'two' => self::TYPE_INT,
        'three' => self::TYPE_STRING,
        'four' => self::TYPE_BOOL,
        'five' => self::TYPE_FLOAT,
        'obj' => 'Tests\DummyEntity',
        'obj_two' => 'Tests\DummyEntitySecond',
    ];
}
