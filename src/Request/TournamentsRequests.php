<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Request;

use Avolle\Fotballdata\Endpoint\TournamentsEndpoints;
use Avolle\Fotballdata\Entity\EntityInterface;

/**
 * Tournaments Requests
 */
class TournamentsRequests extends BaseRequest
{
    /**
     * Get information for a tournament from the API
     *
     * @param int $id Tournament id
     * @return \Avolle\Fotballdata\Entity\Tournament
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function get(int $id): EntityInterface
    {
        $endpoint = (new TournamentsEndpoints())->get($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get matches for a tournament from the API
     *
     * @param int $id Tournament id
     * @return \Avolle\Fotballdata\Entity\Tournament
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function matches(int $id): EntityInterface
    {
        $endpoint = (new TournamentsEndpoints())->matches($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get tables for a tournament from the API
     *
     * @param int $id Tournament id
     * @return \Avolle\Fotballdata\Entity\Tournament
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function tables(int $id): EntityInterface
    {
        $endpoint = (new TournamentsEndpoints())->tables($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get teams for a tournament from the API
     *
     * @param int $id Tournament id
     * @return \Avolle\Fotballdata\Entity\Tournament
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function teams(int $id): EntityInterface
    {
        $endpoint = (new TournamentsEndpoints())->teams($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }
}
