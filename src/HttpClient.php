<?php

namespace Ebski\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Class HttpClient
 *
 * @package Ebski\HttpClient
 */
abstract class HttpClient
{
    /**
     * @param HttpClientConfiguration $configuration
     */
    public function __construct(
        private HttpClientConfiguration $configuration
    ) {}

    /**
     * Overridable request function
     *
     * @param HttpRequest $request
     * @return mixed
     */
    public function request(HttpRequest $request): mixed
    {
        return $this->sendRequest($request);
    }

    /**
     * @param HttpRequest $request
     * @return mixed
     */
    protected function sendRequest(HttpRequest $request): mixed
    {
        $url = $this->configureUrl($request->getEndpoint());
        $request->setOptions(array_merge($request->getOptions(), $this->configuration->getBaseOptions()));
        $request->setHeaders(array_merge($request->getHeaders(), $this->configuration->getBaseHeaders()));

        $client = $this->getHttpClient($request);
        $start = microtime(TRUE);
        $method = $request->getHttpMethod();
        $response = $client->$method($url, $request->getOptions());
        $end = microtime(TRUE);
        $responseTime = $this->getResponseTime($start, $end);
        $this->debugRequest($request, $response, $responseTime);
        return $this->handleResponse($response);
    }

    /**
     * @param HttpRequest $request
     * @return Client
     */
    protected function getHttpClient(HttpRequest $request): Client
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $this->configureMiddleware($stack);

        $options = [
            'base_uri' => $this->configuration->getBaseUri(),
            'handler' => $stack,
            'headers' => $request->getHeaders(),
            'timeout' => $this->configuration->getTimeout(),
        ];
        return new Client($options);
    }

    /**
     * @param float $start
     * @param float $end
     * @return string
     */
    private function getResponseTime(float $start, float $end): string
    {
        $seconds = $end - $start;
        return $seconds >= 1 ? round($seconds, 2) . 's' : round($seconds * 1000, 2) . 'ms';
    }

    /**
     * @param HttpRequest $request
     * @param Response $response
     * @param string $responseTime
     */
    protected function debugRequest(HttpRequest $request, Response $response, string $responseTime)
    {
        if ($this->configuration->shouldDebug()) {
            $message = sprintf(
                '%s: [%s][%s]: %s%s (%s)',
                $this->configuration->getClientName(),
                $request->getHttpMethod(),
                $response->getStatusCode(),
                $this->configuration->getBaseUri(),
                $this->configureUrl($request->getEndpoint()),
                $responseTime
            );
            $this->handleDebugLogMessage($message);
        }
    }

    /**
     * Configure how the URL should look after the base URI
     *
     * @param string $endpoint
     * @return string
     */
    abstract protected function configureUrl(string $endpoint): string;

    /**
     * Overridable function if middleware is needed
     *
     * @param HandlerStack $stack
     */
    protected function configureMiddleware(HandlerStack &$stack): void
    {
        // Default no middleware
    }

    /**
     * Overridable function of how a debug message should be handled
     *
     * @param string $message
     */
    protected function handleDebugLogMessage(string $message): void
    {
        // Default no handling
    }

    /**
     * Configure how the response is handled
     *
     * @param Response $response
     * @return mixed
     */
    protected abstract function handleResponse(Response $response): mixed;
}