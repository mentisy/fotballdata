<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Request;

use Avolle\Fotballdata\Endpoint\SeasonsEndpoints;
use Avolle\Fotballdata\Entity\EntityInterface;

/**
 * Seasons Requests
 */
class SeasonsRequests extends BaseRequest
{
    /**
     * Get all seasons from the API
     *
     * @return \Avolle\Fotballdata\Entity\Season[]
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function all(): array
    {
        $endpoint = (new SeasonsEndpoints())->all();
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get information for a season from the API
     *
     * @param int $id Season id
     * @return \Avolle\Fotballdata\Entity\Season
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function get(int $id): EntityInterface
    {
        $endpoint = (new SeasonsEndpoints())->get($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }
}
