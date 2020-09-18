## Http Client
This library can be used to connect through HTTP to other projects.
It's build based on [guzzlehttp/guzzle](https://packagist.org/packages/guzzlehttp/guzzle) library
and functions as a wrapper to quickly setup the main functionality a http-client needs.

## Installation
Using composer:
```
composer require ebski/http-client
```

## Usage
To use the library create a client that extends the HttpClient class and implement the needed functions. 
below and example to talk to the tidesandcurrents api can be seen
````php
<?php

use Ebski\HttpClient\HttpClient;
use Ebski\HttpClient\HttpClientConfiguration;
use Ebski\HttpClient\HttpRequest;
use GuzzleHttp\Psr7\Response;

class TidesAndCurrentsClient extends HttpClient
{
    public function __construct() 
    {
        parent::__construct(new HttpClientConfiguration('https://api.tidesandcurrents.noaa.gov'));
    }

    protected function configureUrl(string $endpoint) : string
    {
        return '/api/prod/datagetter' . ltrim($endpoint, '/');
    }

    protected function handleResponse(Response $response)
    {
        $code = $response->getStatusCode();
        if ($code === 200) {
            return json_decode($response->getBody(), true);
        }
        // Handle exception properly
        throw new Exception();
    }
}

class Test
{
    public function testFunction()
    {
        $client = new TidesAndCurrentsClient();
        $queryParams = [
            'begin_date' => '20130808 15:00',
            'end_date' => '20130808 15:06',
            'station' => 8454000,
            'product' => 'water_temperature',
            'units' => 'english',
            'time_zone' => 'gmt',
            'application' => 'ports_screen',
            'format' => 'json',
        ];   
        $request = new HttpRequest('GET', '', $queryParams);
        $response = $client->request($request);
    }
}
````
