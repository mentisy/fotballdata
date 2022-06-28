<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Request;

use Avolle\Fotballdata\Endpoint\TeamsEndpoints;
use Avolle\Fotballdata\Entity\EntityInterface;

class TeamsRequests extends BaseRequest
{
    /**
     * @param int $id
     * @return \Avolle\Fotballdata\Entity\Team
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function get(int $id): EntityInterface
    {
        $endpoint = (new TeamsEndpoints())->get($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * @param int $id
     * @return \Avolle\Fotballdata\Entity\Team
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function matches(int $id): EntityInterface
    {
        $endpoint = (new TeamsEndpoints())->matches($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * Get tournaments for a team from the API
     *
     * @param int $id Team id
     * @return \Avolle\Fotballdata\Entity\Team
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function tournaments(int $id): EntityInterface
    {
        $endpoint = (new TeamsEndpoints())->tournaments($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }

    /**
     * @param int $id
     * @return \Avolle\Fotballdata\Entity\Team
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    public function players(int $id): EntityInterface
    {
        $endpoint = (new TeamsEndpoints())->players($id);
        $this->sendRequest($endpoint);

        return $this->convertResponse();
    }
}
