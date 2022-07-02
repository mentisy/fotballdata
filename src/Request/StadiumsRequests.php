<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Request;

use Avolle\Fotballdata\Endpoint\StadiumsEndpoints;
use Avolle\Fotballdata\Entity\EntityInterface;

/**
 * Stadiums Requests
 */
class StadiumsRequests extends BaseRequest
{
    /**
     * Get information for a stadium from the API
     *
     * @param int $id Stadium id
     * @return \Avolle\Fotballdata\Entity\Stadium
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function get(int $id): EntityInterface
    {
        $endpoint = (new StadiumsEndpoints())->get($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get matches for a stadium from the API
     *
     * @param int $id Stadium id
     * @return \Avolle\Fotballdata\Entity\Stadium
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function matches(int $id): EntityInterface
    {
        $endpoint = (new StadiumsEndpoints())->matches($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get club matches for a stadium from the API
     *
     * @param int $id Stadium id
     * @param int $clubId Club id
     * @return \Avolle\Fotballdata\Entity\Stadium
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function clubMatches(int $id, int $clubId): EntityInterface
    {
        $endpoint = (new StadiumsEndpoints())->clubMatches($id, $clubId);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get children stadiums for a stadium from the API
     *
     * @param int $id Stadium id
     * @return array<\Avolle\Fotballdata\Entity\Stadium>
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function children(int $id): array
    {
        $endpoint = (new StadiumsEndpoints())->children($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }
}
