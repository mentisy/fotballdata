<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

use Avolle\Fotballdata\Exception\EntityClassNotFoundException;
use Avolle\Fotballdata\Utility\Inflector;

/**
 * Helper functions for entities
 */
trait EntityTrait
{
    /**
     * Finds the entity name for a given property
     *
     * @param string $property Entity property
     * @return string
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     */
    protected function entityClassName(string $property): string
    {
        $baseEntityClassName = EntityInterface::class;
        $entityClassName = Inflector::singularize(ucwords($property));
        if (isset($this->aliases, $this->aliases[$entityClassName])) {
            $entityClassName = $this->aliases[$entityClassName];
        }
        $class = str_replace('EntityInterface', $entityClassName, $baseEntityClassName);
        if (!class_exists($class)) {
            throw new EntityClassNotFoundException(sprintf('Could not find entity `%s`.', $class));
        }

        return $class;
    }
}
