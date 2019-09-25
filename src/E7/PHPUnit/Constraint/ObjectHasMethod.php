<?php

namespace E7\PHPUnit\Constraint;

class ObjectHasMethod extends \PHPUnit\Framework\Constraint
{
    /** @var string */
    private $method;
    
    /**
     * Constructor
     * 
     * @param string $method
     */
    public function __construct($method)
    {
        $this->method = $method;
    }
    
    public function __toString()
    {
        return 'method exists';
    }
    
    /**
     * @inheritdoc
     */
    public function matches($object)
    {
        return method_exists($object, $this->method);
    }
}
