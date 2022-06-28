<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Endpoints for Matches requests
 */
class MatchesEndpoints extends BaseEndpoint
{
    /**
     * @inheritdoc
     */
    public const BASE_ENDPOINT = 'matches/';

    /**
     * Create endpoint to get information for a match
     *
     * @param int $id Match id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function get(int $id): EndpointInterface
    {
        return $this->createEndpoint($id);
    }

    /**
     * Create endpoint to get people for a match
     *
     * @param int $id Match id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function people(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'people');
    }

    /**
     * Create endpoint to get people and events for a match
     *
     * @param int $id Match id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function peopleAndEvents(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'peopleandevents');
    }
}
