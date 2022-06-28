<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Endpoint Interface
 */
interface EndpointInterface
{
    /**
     * Get defined URL For endpoint
     *
     * @return string
     */
    public function getUrl(): string;
}
