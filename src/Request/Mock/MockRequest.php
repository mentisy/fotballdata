<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Request\Mock;

use Avolle\Fotballdata\Endpoint\EndpointInterface;
use Avolle\Fotballdata\Exception\MockFileNotFoundException;
use Avolle\Fotballdata\Request\BaseRequest;
use Cake\Http\Client\Response;
use LogicException;

/**
 * Mock a Request Response
 */
class MockRequest
{
    /**
     * Path to mocked requests
     */
    public const MOCK_REQUEST_PATH = __DIR__ . '/../../../tests/test_requests/';

    /**
     * Mocked method
     */
    protected const METHOD = 'GET';

    /**
     * Mocked URL
     *
     * @var string
     */
    protected string $url = '';

    /**
     * Mocked response
     *
     * @var \Cake\Http\Client\Response
     */
    protected Response $response;

    /**
     * Create a MockResponse based on Request class, endpoint and query URL
     *
     * @param \Avolle\Fotballdata\Request\BaseRequest $request Request class
     * @param \Avolle\Fotballdata\Endpoint\EndpointInterface $endpoint Endpoint
     * @param array<string, mixed> $query Query URL
     * @throws \Avolle\Fotballdata\Exception\MockFileNotFoundException
     */
    public function __construct(BaseRequest $request, EndpointInterface $endpoint, array $query)
    {
        $this->setUrl($request, $endpoint, $query);
        $this->setResponse($endpoint);
    }

    /**
     * Get method to mock
     *
     * @return string
     */
    public function getMethod(): string
    {
        return self::METHOD;
    }

    /**
     * Get URL to mock
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set mocked response
     *
     * @return \Cake\Http\Client\Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * Set URL to mock
     *
     * @param \Avolle\Fotballdata\Request\BaseRequest $request Request class
     * @param \Avolle\Fotballdata\Endpoint\EndpointInterface $endpoint Endpoint
     * @param array<string, mixed> $query Query URL
     * @return void
     */
    protected function setUrl(BaseRequest $request, EndpointInterface $endpoint, array $query): void
    {
        $this->url = sprintf(
            '%s://%s/%s',
            $request::SCHEME,
            $request->config->read('host'),
            $endpoint->getUrl(),
        );
        if (!empty($query)) {
            $this->url .= '?' . http_build_query($query);
        }
    }

    /**
     * Set mock response based on endpoint
     *
     * @param \Avolle\Fotballdata\Endpoint\EndpointInterface $endpoint Endpoint
     * @throws \Avolle\Fotballdata\Exception\MockFileNotFoundException
     */
    protected function setResponse(EndpointInterface $endpoint, int $status = 200): void
    {
        $mockFile = $this->mockFile($endpoint);
        if (!file_exists($mockFile)) {
            throw new MockFileNotFoundException(sprintf('Mock file `%s` could not be found.', $mockFile));
        }
        $this->response = (new Response([], file_get_contents($mockFile)))
            ->withStatus($status)
            ->withAddedHeader('Was-Mocked', 'true');
    }

    /**
     * Figure out which file to use in mock response
     *
     * If /category ($requestAll), then request is for all entities
     * If /category/1 ($requestGet), then request is for a single entity, without associated data
     * If /category/1/associated ($requestWithAssociatedData), then request is for a single entity, associated data included
     *
     * @param \Avolle\Fotballdata\Endpoint\EndpointInterface $endpoint Endpoint
     * @return string
     */
    protected function mockFile(EndpointInterface $endpoint): string
    {
        $tryRequestRegex = [
            'requestAll' => '/^([a-z]+)\/?$/', // stadiums/
            'requestGet' => '/^([a-z]+)\/\d+\/?$/', // stadiums/1
            'requestGetWithAssociatedData' => '/^([a-z]+)\/(?:\d+\/)?([a-z]+)$/', // stadiums/1/matches
            'requestGetWithAssociatedDataExtended' => '/^([a-z]+)\/\d+\/([a-z]+)\/\d+\/([a-z]+)\/?$/', // stadiums/1/clubs/2/matches
        ];

        $matchedRequestType = false;
        foreach ($tryRequestRegex as $requestType => $requestCheck) {
            if (preg_match($requestCheck, $endpoint->getUrl(), $matches)) {
                array_shift($matches);
                $matchedRequestType = $requestType;
                break;
            }
        }

        switch ($matchedRequestType) {
            case 'requestAll':
                [$category] = $matches;
                return self::MOCK_REQUEST_PATH . $category . DS . 'all.json';
            case 'requestGet':
                [$category] = $matches;
                return self::MOCK_REQUEST_PATH . $category . DS . 'get.json';
            case 'requestGetWithAssociatedData':
                [$category, $association] = $matches;
                return self::MOCK_REQUEST_PATH . $category . DS . $association . '.json';
            case 'requestGetWithAssociatedDataExtended':
                [$category, $association, $extended] = $matches;
                return self::MOCK_REQUEST_PATH . $category . DS . $association . DS . $extended . '.json';
        }

        throw new LogicException(sprintf('Could not find mocked response file `%s`.', $endpoint->getUrl()));
    }
}
