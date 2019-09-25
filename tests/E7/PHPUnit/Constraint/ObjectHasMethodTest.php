<?php

namespace E7\Tests\PHPUnit\Constraint;

use E7\PHPUnit\Constraint\ObjectHasMethod;
use PHPUnit\Framework\TestCase;

class ObjectHasMethodTest extends TestCase
{
    /**
     * @dataProvider providerMatch
     * 
     * @param string $method
     * @param object|string $object
     * @param boolean $expected
     */
    public function testMatch($method, $object, $expected)
    {
        $constraint = new ObjectHasMethod($method);
        $this->assertEquals($expected, $constraint->matches($object));
    }
    
    /**
     * @return array
     */
    public function providerMatch()
    {
        return [
            [
                'providerMatch',
                $this,
                true
            ],
            [
                'providerMatch',
                get_class($this),
                true
            ],
            [
                'notExistingMethod',
                $this,
                false
            ],
            [
                'notExistingMethod',
                get_class($this),
                false
            ],
        ];
    }
}
