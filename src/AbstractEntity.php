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
        return (count($this->properties) == 0 || in_array($property, $this->properties));
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
    protected function set($property, $arguments)
    {
        if (count($arguments) == 0) {

            trigger_error('Missing argument on method ' . __CLASS__ . '::set_' . $property . '() call', E_USER_ERROR);
        }

        $this->data[$property] = $arguments[0];

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
