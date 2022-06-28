<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Request;

use Avolle\Fotballdata\Config\Config;
use Avolle\Fotballdata\Endpoint\EndpointInterface;
use Avolle\Fotballdata\Entity\EntityArray;
use Avolle\Fotballdata\Entity\EntityTrait;
use Avolle\Fotballdata\Exception\InvalidConfigException;
use Avolle\Fotballdata\Exception\InvalidResponseException;
use Avolle\Fotballdata\Utility\Inflector;
use Cake\Http\Client;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Base Request. Extend this class to create requests
 */
abstract class BaseRequest
{
    use EntityTrait;

    /**
     * HTTP Scheme
     */
    protected const SCHEME = 'https';

    /**
     * Format to retrieve results in
     */
    protected const FORMAT = 'json';

    /**
     * Entity name for class. Is calculated, but can be overwritten
     *
     * @var string
     */
    public string $entityName;

    /**
     * HTTP Client
     *
     * @var \Cake\Http\Client
     */
    protected ClientInterface $client;

    /**
     * Config instance
     *
     * @var \Avolle\Fotballdata\Config\Config
     */
    public Config $config;

    /**
     * Default config
     *
     * - debug - Boolean value that defines whether to use debug values on requests (which host and SSL props)
     * - clubId - The club's ID in the FIKS system
     * - cid - Client id from Fotballdata Auth
     * - cwd - Client password from Fotballdata Auth
     *
     * @var array<string, mixed>
     */
    public array $defaultConfig = [
        'debug' => false,
        'host' => 'api.fotballdata.no/v1',
    ];

    /**
     * Response body string
     *
     * @var string|null
     */
    private ?string $responseBody = null;

    /**
     * Constructor
     *
     * @param array<string, mixed> $config Config to overwrite default
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['clubId'], $config['cid'], $config['cwd'])) {
            throw new InvalidConfigException('You must specify `clubId`, `cid` and `cwd` in config array.');
        }
        if (!isset($this->entityName)) {
            $this->entityName = $this->defaultEntityName();
        }
        $this->config = new Config(array_merge($this->defaultConfig, $config));
        $this->client = $this->createClient($this->config);
    }

    /**
     * Send requests defined by endpoint and configuration
     *
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    protected function sendRequest(EndpointInterface $endpoint): ResponseInterface
    {
        $url = $endpoint->getUrl();

        $query = [
            'clubId' => $this->config->read('clubId'),
            'cid' => $this->config->read('cid'),
            'cwd' => $this->config->read('cwd'),
            'format' => self::FORMAT,
        ];
        $response = $this->client->get($url, $query);
        $this->responseBody = $response->getBody()->getContents();
        if ($response->getStatusCode() !== 200 && empty($this->responseBody)) {
            throw new InvalidResponseException(sprintf(
                'Request tried `%s`, but response returned with code %s (%s)',
                $endpoint->getUrl(),
                $response->getStatusCode(),
                $response->getReasonPhrase(),
            ));
        }

        return $response;
    }

    /**
     * Convert the received response from sent request to entities (or array of entities)
     * Will throw exceptions if the received response is not correct
     *
     * @return \Avolle\Fotballdata\Entity\EntityInterface|\Avolle\Fotballdata\Entity\EntityInterface[]
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     */
    protected function convertResponse()
    {
        $jsonDecodedBody = json_decode($this->responseBody);
        if (is_null($jsonDecodedBody)) {
            throw new InvalidResponseException('Response could not be converted from JSON into usable entity data');
        }
        if (is_array($jsonDecodedBody)) {
            return (new EntityArray($this->entityName, $jsonDecodedBody))->toArray();
        } else {
            $className = $this->entityClassName($this->entityName);

            return new $className($jsonDecodedBody);
        }
    }

    /**
     * Calculate the default entity name to use based on the request class name
     *
     * @return string
     */
    private function defaultEntityName(): string
    {
        $class = static::class;
        $namespaces = explode('\\', $class);
        $thisClassName = end($namespaces);
        $entityClassName = str_replace('Requests', '', $thisClassName);

        return Inflector::singularize($entityClassName);
    }

    /**
     * Create an HTTP client based on configuration
     *
     * @param \Avolle\Fotballdata\Config\Config $config Config instance
     * @return \Cake\Http\Client
     */
    protected function createClient(Config $config): Client
    {
        $clientConfig = [
            'host' => $config->read('host'),
            'scheme' => self::SCHEME,
        ];
        if ($this->config->read('debug')) {
            $clientConfig += [
                'ssl_verify_host' => false,
                'ssl_verify_peer' => false,
                'ssl_verify_peer_name' => false,
            ];
        }

        return $this->client ?? $this->client = new Client($clientConfig);
    }
}
