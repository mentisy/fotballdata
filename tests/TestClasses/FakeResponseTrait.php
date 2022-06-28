<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestClasses;

use Cake\Http\Client\Response;
use Cake\Http\TestSuite\HttpClientTrait;

/**
 * Create fake response
 */
trait FakeResponseTrait
{
    use HttpClientTrait;

    /**
     * Create a fake response with a 200 OK status code and the body contents of a fake response file
     *
     * @param string $filename Filename in folder `/tests/test_requests`
     * @return \Cake\Http\Client\Response
     */
    public function fakeOkResponse(string $filename): Response
    {
        return $this->newClientResponse(200, [], file_get_contents(TEST_REQUESTS . $filename));
    }

    /**
     * Create a fake response with a 403 Forbidden status code
     *
     * @return \Cake\Http\Client\Response
     */
    public function fakeForbiddenResponse(): Response
    {
        return $this->newClientResponse(403);
    }

    /**
     * Create a fake response with a 404 Not Found status code
     *
     * @param string|null $filename Filename in folder `/tests/test_requests`
     * @return \Cake\Http\Client\Response
     */
    public function fakeNotFoundResponse(?string $filename = null): Response
    {
        $body = empty($filename) ? '' : file_get_contents(TEST_REQUESTS . $filename);

        return $this->newClientResponse(404, [], $body);
    }
}
