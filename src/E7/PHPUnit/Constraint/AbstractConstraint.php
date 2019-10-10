<?php

namespace E7\PHPUnit\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

abstract class AbstractConstraint extends Constraint
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return method_exists($this, 'toString')
            ? $this->toString()
            : get_class($this) . '::toString() is not implemented';
    }
}