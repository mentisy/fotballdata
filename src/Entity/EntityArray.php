<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Entity array class
 *
 * Convert an array of values into an array of entities
 */
class EntityArray
{
    use EntityTrait;

    /**
     * Entities converted
     *
     * @var array<int, \Avolle\Fotballdata\Entity\EntityInterface>
     */
    protected array $entities;

    /**
     * Constructor
     *
     * @param string $entityName Entity name to set values to
     * @param array<int, mixed> $values Values to convert
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     */
    public function __construct(string $entityName, array $values)
    {
        $entityClassName = $this->entityClassName($entityName);
        $this->entities = [];

        foreach ($values as $properties) {
            $this->entities[] = new $entityClassName($properties);
        }
    }

    /**
     * Return all converted entities in an array
     *
     * @return array<int, \Avolle\Fotballdata\Entity\EntityInterface>
     */
    public function toArray(): array
    {
        return $this->entities;
    }
}
