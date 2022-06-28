<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Endpoints for Stadiums requests
 */
class StadiumsEndpoints extends BaseEndpoint
{
    /**
     * @inheritdoc
     */
    public const BASE_ENDPOINT = 'stadiums/';

    /**
     * Create endpoint to get information for a stadium
     *
     * @param int $id Stadium id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function get(int $id): EndpointInterface
    {
        return $this->createEndpoint($id);
    }

    /**
     * Create endpoint to get matches for a stadium
     *
     * @param int $id Stadium id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function matches(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'matches');
    }

    /**
     * Create endpoint to get club matches for a stadium
     *
     * @param int $id Stadium id
     * @param int $clubId Club id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function clubMatches(int $id, int $clubId): EndpointInterface
    {
        return $this->createEndpoint($id, 'clubs', $clubId, 'matches');
    }

    /**
     * Create endpoint to get children stadiums for a stadium
     *
     * @param int $id Stadium id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function children(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'children');
    }
}
