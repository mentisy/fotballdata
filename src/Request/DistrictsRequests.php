<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Request;

use Avolle\Fotballdata\Endpoint\DistrictsEndpoints;
use Avolle\Fotballdata\Entity\EntityInterface;

/**
 * Districts Requests
 */
class DistrictsRequests extends BaseRequest
{
    /**
     * Get all districts from the API
     *
     * @return \Avolle\Fotballdata\Entity\District[]
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function all(): array
    {
        $endpoint = (new DistrictsEndpoints())->all();
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get information for a district from the API
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Entity\District
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function get(int $id): EntityInterface
    {
        $endpoint = (new DistrictsEndpoints())->get($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get clubs for a district from the API
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Entity\District
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function clubs(int $id): EntityInterface
    {
        $endpoint = (new DistrictsEndpoints())->clubs($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get teams for a district from the API
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Entity\District
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function teams(int $id): EntityInterface
    {
        $endpoint = (new DistrictsEndpoints())->teams($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get tournaments for a district from the API
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Entity\District
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function tournaments(int $id): EntityInterface
    {
        $endpoint = (new DistrictsEndpoints())->tournaments($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get stadiums for a district from the API
     *
     * @param int $id District id
     * @return \Avolle\Fotballdata\Entity\District
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function stadiums(int $id): EntityInterface
    {
        $endpoint = (new DistrictsEndpoints())->stadiums($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }
}
