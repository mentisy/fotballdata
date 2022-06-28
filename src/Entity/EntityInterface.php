<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Entity interface
 */
interface EntityInterface
{
    /**
     * Set a property in entity
     *
     * @param string $name Name of property
     * @param mixed $value Value of property
     * @return void
     */
    public function set(string $name, $value): void;

    /**
     * Get a property defined in entity
     *
     * @param string $name Name of property
     * @return mixed
     */
    public function get(string $name);
}
