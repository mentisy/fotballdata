<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Endpoint;

/**
 * Endpoints for Districts requests
 */
class DistrictsEndpoints extends BaseEndpoint
{
    /**
     * @inheritdoc
     */
    public const BASE_ENDPOINT = 'districts/';

    /**
     * Create endpoint to get all districts
     *
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function all(): EndpointInterface
    {
        return $this->createEndpoint();
    }

    /** Create endpoint to get information for a district
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function get(int $id): EndpointInterface
    {
        return $this->createEndpoint($id);
    }

    /** Create endpoint to get clubs for a district
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function clubs(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'clubs');
    }

    /** Create endpoint to get teams for a district
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function teams(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'teams');
    }

    /** Create endpoint to get tournaments for a district
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function tournaments(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'tournaments');
    }

    /** Create endpoint to get stadiums for a district
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function stadiums(int $id): EndpointInterface
    {
        return $this->createEndpoint($id, 'stadiums');
    }
}
