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
}
