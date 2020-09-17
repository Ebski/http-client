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
    /**
     * @var string
     */
    private $httpMethod;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var array
     */
    private $options;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var Closure|null
     */
    private $callback;

    /**
     * @param string $httpMethod
     * @param string $endpoint
     * @param array $queryParams
     * @param array $options
     * @param array $headers
     * @param Closure|null $callback
     */
    public function __construct(
        string $httpMethod,
        string $endpoint,
        array $queryParams = [],
        array $options = [],
        array $headers = [],
        Closure $callback = null
    ) {
        $this->httpMethod = $httpMethod;
        $this->endpoint = sprintf('%s?%s', $endpoint, http_build_query($queryParams));
        $this->options = $options;
        $this->headers = $headers;
        $this->callback = $callback;
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
    public function getQueryParams(): array
    {
        return $this->queryParams;
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

    /**
     * @return Closure|null
     */
    public function getCallback(): ?Closure
    {
        return $this->callback;
    }
}