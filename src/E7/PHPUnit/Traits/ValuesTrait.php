<?php

namespace E7\PHPUnit\Traits;

/**
 * Trait ValuesTrait
 * @package E7\PHPUnit\Traits
 */
trait ValuesTrait
{
    /**
     * Generates a random string
     *
     * @param string $prefix
     * @return string
     */
    protected function getRandomString(string $prefix = null)
    {
        if (empty($prefix)) {
            $prefix = 'string';
        }

        return $prefix . '-' . rand(0, 999999);
    }

    /**
     * Generates a random name
     *
     * @return string
     */
    protected function getRandomName()
    {
        return $this->getRandomString('name');
    }
}
