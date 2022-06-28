<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Endpoints for Clubs requests
 */
class ClubsEndpoints extends BaseEndpoint
{
    /**
     * @inheritdoc
     */
    public const BASE_ENDPOINT = 'clubs/';

    /**
     * Create endpoint to get information for a club
     *
     * @param int $id Club id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function get(int $id): EndpointInterface
    {
        return $this->createEndpoint($id);
    }

    /**
     * Create endpoint to get matches for a club
     *
     * @param int $id Club id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function matches(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'matches');
    }

    /**
     * Create endpoint to get teams for a club
     *
     * @param int $id Club id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function teams(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'teams');
    }

    /**
     * Create endpoint to get tournaments for a club
     *
     * @param int $id Club id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function tournaments(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'tournaments');
    }
}
