<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Request;

use Avolle\Fotballdata\Endpoint\MatchesEndpoints;
use Avolle\Fotballdata\Entity\EntityInterface;

/**
 * Matches Requests
 */
class MatchesRequests extends BaseRequest
{
    public string $entityName = 'Game';

    /**
     * Get information for a match from the API
     *
     * @param int $id Match id
     * @return \Avolle\Fotballdata\Entity\Game
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function get(int $id): EntityInterface
    {
        $endpoint = (new MatchesEndpoints())->get($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get people for a match from the API
     *
     * @param int $id Match id
     * @return \Avolle\Fotballdata\Entity\Game
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function people(int $id): EntityInterface
    {
        $endpoint = (new MatchesEndpoints())->people($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get people and events for a match from the API
     *
     * @param int $id Match id
     * @return \Avolle\Fotballdata\Entity\Game
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function peopleAndEvents(int $id): EntityInterface
    {
        $endpoint = (new MatchesEndpoints())->peopleAndEvents($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }
}
