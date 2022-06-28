<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Endpoint builder
 */
class EndpointBuilder implements EndpointInterface
{
    /**
     * Base URL for endpoint
     *
     * @var string
     */
    protected string $base = '';

    /**
     * Defined URL for endpoint
     *
     * @var string
     */
    protected string $url = '';

    /**
     * Constructor
     *
     * @param string $base Base URL
     */
    public function __construct(string $base)
    {
        $this->base = $base;
    }

    /**
     * Set URL
     *
     * @param string|int ...$args Args to append base URL
     * @return $this
     */
    public function setUrl(...$args): self
    {
        $this->url = implode('/', $args);

        return $this;
    }

    /**
     * Get defined URL for endpoint
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->base . $this->url;
    }
}
