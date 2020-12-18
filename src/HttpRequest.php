<?php

namespace Ebski\HttpClient;

/**
 * Class HttpRequest
 *
 * @package Ebski\HttpClient
 */
class HttpRequest
{
    /**
     * @param string $httpMethod
     * @param string $endpoint
     * @param array $queryParams
     * @param array $options
     * @param array $headers
     */
    public function __construct(
        private string $httpMethod,
        private string $endpoint,
        array $queryParams = [],
        private array $options = [],
        private array $headers = []
    ) {
        $this->endpoint = sprintf('%s?%s', $endpoint, http_build_query($queryParams));
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