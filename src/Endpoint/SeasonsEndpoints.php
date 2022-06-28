<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Endpoints for Seasons requests
 */
class SeasonsEndpoints extends BaseEndpoint
{
    /**
     * @inheritdoc
     */
    public const BASE_ENDPOINT = 'seasons/';

    /**
     * Create endpoint to get all seasons
     *
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function all(): EndpointInterface
    {
        return $this->createEndpoint();
    }

    /**
     * Create endpoint to get information for a season
     *
     * @param int $id Season id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function get(int $id): EndpointInterface
    {
        return $this->createEndpoint($id);
    }
}
