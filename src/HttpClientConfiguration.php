<?php

namespace Ebski\HttpClient;

/**
 * Class HttpClientConfiguration
 *
 * @package Ebski\HttpClient
 */
class HttpClientConfiguration
{
    /**
     * The base URI where each request is sent
     */
    private string $baseUri;

    /**
     * Base options for the client
     */
    private array $baseOptions;

    /**
     * Base headers for the client
     */
    private array $baseHeaders;

    /**
     * How long each request should wait before a timeout
     * Default value 0 is to wait indefinitely
     */
    private float $timeout;

    /**
     * Whether or not a request should be debugged
     */
    private bool $debug;

    /**
     * The name the client is shown while debugging
     */
    private string $clientName;

    /**
     * @param string $baseUri
     * @param array $baseOptions
     * @param array $baseHeaders
     * @param float $timeout
     * @param bool $debug
     * @param string $clientName
     */
    public function __construct(
        string $baseUri,
        array $baseOptions = [],
        array $baseHeaders = [],
        float $timeout = 0,
        bool $debug = false,
        string $clientName = 'client'
    ) {
        $this->baseUri = $baseUri;
        $this->baseOptions = $baseOptions;
        $this->baseHeaders = $baseHeaders;
        $this->timeout = $timeout;
        $this->debug = $debug;
        $this->clientName = $clientName;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @return array
     */
    public function getBaseOptions(): array
    {
        return $this->baseOptions;
    }

    /**
     * @return array
     */
    public function getBaseHeaders(): array
    {
        return $this->baseHeaders;
    }

    /**
     * @return float
     */
    public function getTimeout(): float
    {
        return $this->timeout;
    }

    /**
     * @return bool
     */
    public function shouldDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }
}