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
     * Template test for setters
     *
     * @param object     $object
     * @param string     $property
     * @param mixed|null $value
     * @param array      $options
     *
     * @return void
     */
    protected function doTestSetter(
        object $object,
        string $property,
        mixed $value = null,
        array $options = []
    ) {
        $method = 'set' . $property;

        $this->assertObjectHasMethod($method, $object, 'Setter does not exists');
        $this->assertEquals($object, call_user_func([$object, $method]), 'Setter does not support fluent interface (method chaining).');
    }

    /**
     * Template test for getters
     *
     * @param object     $object
     * @param string     $property
     * @param mixed|null $value
     * @param array      $options
     *
     * @return void
     */
    protected function doTestGetter(
        object $object,
        string $property,
        mixed $value = null,
        array $options = []
    ) {
        $method = 'get' . $property;

        $this->assertObjectHasMethod($method, $object, 'Getter does not exists');
        $this->assertEquals($object, call_user_func([$object, $method]), 'Getter does not return the expected value.');
    }

    /**
     * Template test for setters and getters
     *
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

        $this->doTestSetter($object, $property, $value, $options);
        $this->doTestGetter($object, $property, $value, $options);
    }
}
