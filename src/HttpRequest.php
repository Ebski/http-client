<?php

namespace Ebski\HttpClient;

use Closure;

/**
 * Class HttpRequest
 *
 * @package Ebski\HttpClient
 */
class HttpRequest
{
    private string $httpMethod;

    private string $endpoint;

    private array $options;

    private array $headers;

    /**
     * @param string $httpMethod
     * @param string $endpoint
     * @param array $queryParams
     * @param array $options
     * @param array $headers
     */
    public function __construct(
        string $httpMethod,
        string $endpoint,
        array $queryParams = [],
        array $options = [],
        array $headers = []
    ) {
        $this->httpMethod = $httpMethod;
        $this->endpoint = sprintf('%s?%s', $endpoint, http_build_query($queryParams));
        $this->options = $options;
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }
}