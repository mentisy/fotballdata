<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Endpoints for Tournaments requests
 */
class TournamentsEndpoints extends BaseEndpoint
{
    /**
     * @inheritdoc
     */
    public const BASE_ENDPOINT = 'tournaments/';

    /**
     * Create endpoint to get information for a tournament
     *
     * @param int $id Tournament id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function get(int $id): EndpointInterface
    {
        return $this->createEndpoint($id);
    }

    /**
     * Create endpoint to get matches for a tournament
     *
     * @param int $id Tournament id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function matches(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'matches');
    }

    /**
     * Create endpoint to get tables for a tournament
     *
     * @param int $id Tournament id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function tables(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'tables');
    }

    /**
     * Create endpoint to get teams for a tournament
     *
     * @param int $id Tournament id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function teams(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'teams');
    }
}
