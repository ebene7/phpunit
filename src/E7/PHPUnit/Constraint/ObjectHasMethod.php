<?php

namespace E7\PHPUnit\Constraint;

class ObjectHasMethod extends AbstractConstraint
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
    
    public function __toString():string
    {
        return 'method exists';
    }

    public function toString():string
    {
        return 'method exists';
    }
    
    /**
     * @inheritdoc
     */
    public function matches($other):bool
    {
        return method_exists($other, $this->method);
    }
}
