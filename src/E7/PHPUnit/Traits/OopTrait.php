<?php

namespace E7\PHPUnit\Traits;

use E7\PHPUnit\Constraint\ObjectHasMethod;

trait OopTrait
{
    /**
     * @param string $method
     * @param object|string $object
     * @param string $message
     */
    public function assertObjectHasMethod($method, $object, $message = '')
    {
        static::assertThat($object, new ObjectHasMethod($method), $message);
    }

    /**
     * @param type $object
     * @param string $property
     * @param mixed $value
     * @param array $options
     *
     * @return void
     */
    protected function doTestGetterAndSetter(
        $object,
        string $property,
        mixed $value = null,
        array $options = []
    ) {
        $value = $value ?: md5(rand(1, 10000));

        $getter = 'get' . $property;
        $setter = 'set' . $property;

        $this->assertObjectHasMethod($getter, $object);
        $this->assertObjectHasMethod($setter, $object);

        $this->assertEquals($object, call_user_func([$object, $setter], $value));
        $this->assertEquals($value, call_user_func([$object, $getter]));
    }
}
