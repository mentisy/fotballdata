<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestClasses;

use Avolle\Fotballdata\Endpoint\BaseEndpoint;
use Avolle\Fotballdata\Endpoint\EndpointInterface;

/**
 * Test class to test BaseEndpoint class
 */
class AbstractedBaseEndpoint extends BaseEndpoint
{
    /**
     * @inheritdoc
     */
    protected const BASE_ENDPOINT = 'teams/';

    /**
     * Create an abstracted endpoint create class
     *
     * @param string|int ...$args Args
     * @return \Avolle\Fotballdata\Endpoint\EndpointInterface
     */
    public function createTestEndpoint(...$args): EndpointInterface
    {
        return $this->createEndpoint(...$args);
    }
}
