<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Helper methods for entities
 */
trait EntityHelperTrait
{
    /**
     * Convert a property name's value into a datetime string
     *
     * @param string $property Property name to convert date
     * @return string
     */
    public function toDate(string $property): string
    {
        #/Date(1650578307030-0000)/
        $pattern = '/\/Date\((\d+)-(\d+)\)\//';
        if (!isset($this->$property) || !preg_match($pattern, $this->$property, $matches)) {
            return 'Unknown';
        }
        [, $timeInMilliseconds] = $matches;

        return date('Y-m-d H:i:s', (int)((int)$timeInMilliseconds / 1000));
    }

    /**
     * Returns an array of name parts for a given full name.
     * Makes a best-guess where only the last part of the name is determined to be the surname, and the rest first name.
     *
     * If $indexed = false:
     * - Key 0: First name
     * - Key 1: Surname
     *
     * If $indexed = true
     * - Key `firstName` = First name
     * - Key `surname` = Surname
     *
     * @return array<string>
     */
    public function toNameParts(string $fullName, bool $indexed = false): array
    {
        $firstName = substr($fullName, 0, strrpos($fullName, ' '));
        $surname = substr($fullName, strrpos($fullName, ' ') + 1, strlen($fullName));

        if ($indexed) {
            return compact('firstName', 'surname');
        }

        return [$firstName, $surname];
    }
}
