<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Base endpoint. Extend this to defined endpoints
 */
abstract class BaseEndpoint
{
    /**
     * Base endpoint. Will be preprended all endpoints URLs
     */
    protected const BASE_ENDPOINT = '';

    /**
     * Create an endpoint using the endpoint builder and appending the arguments
     *
     * @param string|int ...$args Arguments to append the endpoint URL
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    protected function createEndpoint(...$args): EndpointInterface
    {
        return (new EndpointBuilder(static::BASE_ENDPOINT))->setUrl(...$args);
    }
}
