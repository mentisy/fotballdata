<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Request;

use Avolle\Fotballdata\Endpoint\ClubsEndpoints;
use Avolle\Fotballdata\Entity\EntityInterface;

/**
 * Clubs Requests
 */
class ClubsRequests extends BaseRequest
{
    /**
     * Get information for a club from the API
     *
     * @param int $id Club id
     * @return \Avolle\Fotballdata\Entity\Club
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function get(int $id): EntityInterface
    {
        $endpoint = (new ClubsEndpoints())->get($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get matches for a club from the API
     *
     * @param int $id Club id
     * @return \Avolle\Fotballdata\Entity\Club
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function matches(int $id): EntityInterface
    {
        $endpoint = (new ClubsEndpoints())->matches($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get teams for a club from the API
     *
     * @param int $id Club id
     * @return \Avolle\Fotballdata\Entity\Club
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function teams(int $id): EntityInterface
    {
        $endpoint = (new ClubsEndpoints())->teams($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get tournaments for a club from the API
     *
     * @param int $id Club id
     * @return \Avolle\Fotballdata\Entity\Club
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function tournaments(int $id): EntityInterface
    {
        $endpoint = (new ClubsEndpoints())->tournaments($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }
}
