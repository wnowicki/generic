<?php
/*
 * This file is part of the WNowicki\Generic package.
 *
 * (c) WNowicki <dev@wnowicki.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WNowicki\Generic;

use WNowicki\Generic\Contracts\Arrayable;
use WNowicki\Generic\Contracts\Entity;
use WNowicki\Generic\Contracts\Jsonable;
use WNowicki\Generic\Contracts\Makeable;
use WNowicki\Generic\Exceptions\InvalidArgumentException;

/**
 * Abstract Entity
 *
 * To define limited getters and setters, set names of available properties in $this->properties array (snake_case).
 * Also documenting available properties getters and setters using @ method is strongly recommended.
 *
 * @package WNowicki\Generic
 */
abstract class AbstractEntity implements Entity, Makeable, Jsonable
{
    const TYPE_ARRAY = 1;
    const TYPE_BOOL = 2;
    const TYPE_INT = 4;
    const TYPE_STRING = 8;
    const TYPE_FLOAT = 16;

    private $data = [];

    protected $properties = [];

    /**
     * Make Entity
     *
     * @author WN
     * @param array $components
     * @return static
     */
    public static function make(array $components)
    {
        $entity = new static();

        foreach ($components as $k => $v) {

            if ($entity->isPropertyAllowed($k)) {

                $entity->{'set' . $entity->snakeToCamel($k)}($v);
            }
        }

        return $entity;
    }

    /**
     * @author WN
     * @param string $name
     * @param array $arguments
     * @return $this|null
     */
    public function __call($name, $arguments)
    {
        $action = substr($name, 0, 3);
        $property = $this->camelToSnake(substr($name, 3));

        if ($this->isPropertyAllowed($property)) {

            switch ($action) {
                case 'set':
                    return $this->set($property, $arguments);
                case 'get':
                    return $this->get($property);
            }
        }

        trigger_error('Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR);
    }

    /**
     * To Array
     *
     * @author WN
     * @param bool $recursively If set to `true` then toArray(true) will be called on each `Arrayable` property
     * @return array
     */
    public function toArray($recursively = false)
    {
        $rtn = [];

        foreach ($this->data as $k => $v) {

            if ($recursively && $v instanceof Arrayable) {
                $rtn[$k] = $v->toArray(true);
                continue;
            }

            $rtn[$k] = $v;
        }

        return $rtn;
    }

    /**
     * @author WN
     * @param string $property
     * @return bool
     */
    private function isPropertyAllowed($property)
    {
        return (
            count($this->properties) == 0 ||
            in_array($property, $this->properties) ||
            array_key_exists($property, $this->properties)
        );
    }

    /**
     * @author WN
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * JSON representation of an object
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(true), $options);
    }

    /**
     * @author WN
     * @param string $property
     * @param array $arguments
     * @return $this
     */
    private function set($property, $arguments)
    {
        if (count($arguments) == 0) {

            trigger_error('Missing argument on method ' . __CLASS__ . '::set_' . $property . '() call', E_USER_ERROR);
        }

        $this->data[$property] = $this->processInputValue($arguments[0], $property);

        return $this;
    }

    /**
     * @author WN
     * @param string $property
     * @return mixed|null
     */
    private function get($property)
    {
        if (array_key_exists($property, $this->data)) {

            return $this->data[$property];
        }

        return null;
    }

    /**
     * @author WN
     * @param mixed $value
     * @param string|int $type
     * @return mixed
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function processInputValue($value, $type)
    {
        if (array_key_exists($type, $this->properties)) {

            if ($this->isInternalType($type)) {

                return $this->processInternalType($value, $type);
            }

            return $this->processObjectType($value, $type);
        }

        return $value;
    }

    /**
     * @author WN
     * @param $type
     * @return bool
     */
    private function isInternalType($type)
    {
        return is_numeric($type) && array_key_exists($type, $this->propertyInternalTypes());
    }

    /**
     * @author WN
     * @param mixed $value
     * @param int $type
     * @return int|float|bool|string|array
     * @throws InvalidArgumentException
     */
    private function processInternalType($value, $type)
    {
        if ($this->validateInternalType($value, $type)) {

            return $type;
        }

        throw new InvalidArgumentException(
            'Expected value to be type of [' . $this->propertyInternalTypes()[$type] .
            '] type [' . $this->checkType($value) . '] was given'
        );
    }

    /**
     * @param mixed $value
     * @param string $type
     * @return object mixed
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function processObjectType($value, $type)
    {
        if (!class_exists($type)) {

            throw new Exception('Non existing class');
        }

        if (is_array($value) && is_subclass_of($type, 'WNowicki\Generic\Contracts\Makeable')) {

            return $type::make($value);
        }

        if (is_a($value, $type)) {

            return $value;
        }

        throw new InvalidArgumentException(
            'Expected value to be object of [' . $type . '] type ' . $this->checkType($value) . '] was given'
        );
    }

    /**
     * @author WN
     * @param $value
     * @param $type
     * @return bool|null
     */
    private function validateInternalType($value, $type)
    {
        switch ($type) {
            case self::TYPE_ARRAY:
                return is_array($value);
            case self::TYPE_INT:
                return is_int($value);
            case self::TYPE_STRING:
                return is_string($value);
            case self::TYPE_BOOL:
                return is_bool($value);
            case self::TYPE_FLOAT:
                return is_float($value);
        }
    }

    /**
     * @author WN
     * @return array
     */
    private function propertyInternalTypes()
    {
        return [
            self::TYPE_ARRAY => 'array',
            self::TYPE_INT => 'int',
            self::TYPE_STRING => 'string',
            self::TYPE_BOOL => 'bool',
            self::TYPE_FLOAT => 'float',
        ];
    }

    /**
     * @author WN
     * @param mixed $value
     * @return string
     */
    private function checkType($value)
    {
        if (is_object($value)) {

            return get_class($value);
        }

        return gettype($value);
    }

    /**
     * @author WN
     * @param string $string
     * @return string
     */
    private function camelToSnake($string)
    {
        $string[0] = strtolower($string[0]);
        return strtolower(preg_replace("/([A-Z])/", "_$1", $string));
    }

    /**
     * @author WN
     * @param $string
     * @return mixed
     */
    private function snakeToCamel($string)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    }
}
