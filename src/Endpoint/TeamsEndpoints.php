<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Endpoints for Teams requests
 */
class TeamsEndpoints extends BaseEndpoint
{
    /**
     * @inheritdoc
     */
    public const BASE_ENDPOINT = 'teams/';

    /**
     * Create endpoint to get information for a team
     *
     * @param int $id Team id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function get(int $id): EndpointInterface
    {
        return $this->createEndpoint($id);
    }

    /**
     * Create endpoint to get matches for a team
     *
     * @param int $id Team id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function matches(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'matches');
    }

    /**
     * Create endpoint to get tournaments for a team
     *
     * @param int $id Team id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function tournaments(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'tournaments');
    }

    /**
     * Create endpoint to get tables for a team
     *
     * @param int $id Team id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function tables(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'tables');
    }

    /**
     * Create endpoint to get players for a team
     *
     * @param int $id Team id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function players(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'players');
    }
}
