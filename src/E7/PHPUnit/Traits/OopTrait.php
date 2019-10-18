<?php

namespace E7\PHPUnit\Traits;

use Countable;
use E7\PHPUnit\Constraint\ObjectHasMethod;
use IteratorAggregate;
use Traversable;

/**
 * Trait OopTrait
 * @package E7\PHPUnit\Traits
 */
trait OopTrait
{
    /**
     * @param string        $method
     * @param object|string $object
     * @param string        $message
     */
    public function assertObjectHasMethod($method, $object, $message = '')
    {
        static::assertThat($object, new ObjectHasMethod($method), $message);
    }

    /**
     * @param object|string $object
     * @param string        $message
     */
    public function assertObjectHasConstructor($object, $message = '')
    {
        $message = !empty($message) ? $message : 'Constructor does not exist';
        $this->assertObjectHasMethod('__constructor', $object, $message);
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
        $object,
        string $property,
        $value = null,
        array $options = []
    ) {
        $method = 'set' . $property;

        $this->assertObjectHasMethod($method, $object, 'Setter does not exists');
        $this->assertSame(
            $object,
            call_user_func([$object, $method], $value),
            'Setter does not support fluent interface (method chaining)'
        );
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
        $object,
        string $property,
        $value = null,
        array $options = []
    ) {
        $method = 'get' . $property;

        $this->assertObjectHasMethod($method, $object, 'Getter does not exists');
        $this->assertSame($value, call_user_func([$object, $method]), 'Getter does not return the expected value');
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
        $value = null,
        array $options = []
    ) {
        $value = $value ?: md5(rand(1, 10000));

        $this->doTestSetter($object, $property, $value, $options);
        $this->doTestGetter($object, $property, $value, $options);
    }

    /**
     * @param object $object
     * @param array  $types
     *
     * @return void
     */
    protected function doTestObjectIsInstanceOf(
        $object,
        array $types
    ) {
        foreach ($types as $type) {
            $this->assertInstanceOf($type, $object, 'Object is not an instance of ' . $type);
        }
    }
    
    /**
     * 
     * @param object $object
     */
    protected function doTestMagicMethodToString($object)
    {
        $this->assertInternalType('object', $object);
        $this->assertObjectHasMethod('__toString', $object);
        $this->assertInternalType('string', $object->__toString());
        $this->assertInternalType('string', (string) $object);
    }
    
    /**
     * Test template for SPL Countable implementation
     * 
     * @param object $object
     */
    protected function doTestSplCountableImplementation($object)
    {
        $this->assertInternalType('object', $object);
        $this->assertInstanceOf(Countable::class, $object);
        $this->assertObjectHasMethod('count', $object);
        $this->assertInternalType('int', $object->count());    
        $this->assertInternalType('int', count($object));    
        $this->assertEquals($object->count(), count($object));    
    }
    
    /**
     * Test template for SPL IteratorAggregate implementation
     * 
     * @param object $object
     */
    protected function doTestSplIteratorAggregateImplementation($object)
    {
        $this->assertInternalType('object', $object);
        $this->assertInstanceOf(IteratorAggregate::class, $object);
        $this->assertObjectHasMethod('getIterator', $object);
        $this->assertInstanceOf(Traversable::class, $object->getIterator());
    }
}
