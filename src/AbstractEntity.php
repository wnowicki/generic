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

/**
 * Abstract Entity
 *
 * To define limited getters and setters, set names of available properties in $this->properties array (snake_case).
 * Also documenting available properties getters and setters using @ method is strongly recommended.
 *
 * @package WNowicki\Generic
 */
abstract class AbstractEntity implements EntityInterface
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

            if (count($entity->properties) == 0 || in_array($k, $entity->properties)) {

                $entity->set($k, [$v]);
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
        $property = $this->nameConverter(substr($name, 3));

        if (count($this->properties) == 0 || in_array($property, $this->properties)) {

            if ($action == 'set') {

                return $this->set($property, $arguments);
            }

            if ($action == 'get') {

                return $this->get($property);
            }
        }

        trigger_error('Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR);
    }

    /**
     * To Array
     *
     * This implementation handles automatically Scalars, Arrays and EntityInterface. Everything else is ignored.
     * Return flatten (arrays of scalars (+ null)???) representation of Entity
     *
     * @author WN
     * @return array
     */
    public function toArray()
    {
        $rtn = [];

        foreach ($this->data as $k => $v) {

            if (is_scalar($v) || is_array($v)) {

                $rtn[$k] = $v;
                continue;
            }

            if ($v instanceof EntityInterface) {

                $rtn[$k] = $v->toArray();
            }
        }

        return $rtn;
    }

    /**
     * @author WN
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->toArray());
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
     * @param string $name
     * @return string
     */
    private function nameConverter($name)
    {
        $name[0] = strtolower($name[0]);
        return strtolower(preg_replace("/([A-Z])/", "_$1", $name));
    }
}
