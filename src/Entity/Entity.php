<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Entity base
 *
 * @property \Avolle\Fotballdata\Entity\ResponseStatus $ResponseStatus
 */
class Entity implements EntityInterface
{
    use EntityTrait;

    /**
     * Field values
     *
     * @var array<string, mixed>
     */
    private array $fields = [];

    /**
     * Define properties that will contain an array that should cast the array values to Entities
     * instead of casting the property itself to an entity
     *
     * @var array<string, string>
     */
    protected array $hasMany = [];

    /**
     * Defines the relationship between properties that contain an existing entity, but is named something else
     * I.e: HomeTeamPlayers contain the Player entity, but we need to alias it to Player
     *
     * @var array<string, string>
     */
    protected array $aliases = [];

    /**
     * Constructor
     *
     * @param object|array<string, mixed> $properties Entity properties
     * @throws \Exception
     */
    public function __construct(array|object $properties = [])
    {
        $this->setProperties($properties);
    }

    /**
     * Set properties
     *
     * @param object|array<string, mixed> $properties Entity properties
     * @return void
     * @throws \Exception
     */
    public function setProperties(array|object $properties = []): void
    {
        if (!empty($properties)) {
            foreach ($properties as $property => $value) {
                if (is_object($value)) {
                    $className = $this->entityClassName($property);
                    $object = new $className($value);
                    $this->set($property, $object);
                } elseif (is_array($value)) {
                    if (isset($this->hasMany[$property])) {
                        $className = $this->entityClassName($this->hasMany[$property]);
                    } else {
                        $className = $this->entityClassName($property);
                    }
                    $propertyValues = [];
                    foreach ($value as $array) {
                        if ($array instanceof EntityInterface) {
                            // We don't need to create an entity, since it already is an entity
                            $propertyValues[] = $array;
                        } else {
                            // Create new entity based on values in array
                            $object = new $className((array)$array);
                            $propertyValues[] = $object;
                        }
                    }
                    $this->set($property, $propertyValues);
                } else {
                    $this->set($property, $value);
                }
            }
        }
    }

    /**
     * Set a property in entity
     *
     * @param string $name Name of property
     * @param mixed $value Value of property
     * @return void
     */
    public function set(string $name, $value): void
    {
        $this->fields[$name] = $value;
    }

    /**
     * Get a property defined in entity
     *
     * @param string $name Name of property
     * @return mixed
     */
    public function &get(string $name): mixed
    {
        $value = $this->fields[$name] ?? null;

        return $value;
    }

    /**
     * Magic getter to get field values in entity
     *
     * @param string $field Field name
     * @return mixed Field value
     */
    public function &__get(string $field): mixed
    {
        return $this->get($field);
    }

    /**
     * Magic setter to set field values in entity
     *
     * @param string $field Field name
     * @param mixed $value Field value
     * @return void
     */
    public function __set(string $field, mixed $value): void
    {
        $this->set($field, $value);
    }

    /**
     * Magic checker if field value is set. A null value will return false.
     *
     * @param string $field Field name
     * @return bool
     */
    public function __isset(string $field): bool
    {
        return $this->get($field) !== null;
    }
}
