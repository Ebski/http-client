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
     * @param string $baseUri The base URI where each request is sent
     * @param array $baseOptions Base options for the client
     * @param array $baseHeaders Base headers for the client
     * @param float $timeout How long each request should wait before a timeout. 0 is to wait indefinitely
     * @param bool $debug Whether or not a request should be debugged
     * @param string $clientName The name the client is shown while debugging
     */
    public function __construct(
        private string $baseUri,
        private array $baseOptions = [],
        private array $baseHeaders = [],
        private float $timeout = 0,
        private bool $debug = false,
        private string $clientName = 'client'
    ) {}

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