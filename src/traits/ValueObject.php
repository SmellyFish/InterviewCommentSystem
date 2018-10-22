<?php

/**
 * Can be used to compose value object classes. Member variables of the class this composes to should be declared as
 * protected (if declared as public, the magic getters and setters are bypassed)
 */
trait ValueObject
{
    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        throw new RuntimeException('Value objects are immutable');
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return property_exists($this, $name);
    }
}
