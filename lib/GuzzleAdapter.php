<?php

namespace Divido\MerchantSDKGuzzle5;

use Divido\MerchantSDK\HttpClient\IHttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class GuzzleAdapter
 *
 * @author Neil McGibbon <neil.mcgibbon@divido.com>
 * @author Mike Lovely <mike.lovely@divido.com>
 * @copyright (c) 2018, Divido
 * @package Divido\MerchantSDK
 */
class GuzzleAdapter implements IHttpClient
{
    /**
     * The Guzzle client (might be mocked, so accept interface)
     *
     * @var ClientInterface
     */
    private $client;

    ########################################################
    #                                                      #
    #             P U B L I C    M E T H O D S             #
    #                                                      #
    ########################################################

    /**
     * Guzzle Adapter implementation for HTTP client interface
     *
     * @param ClientInterface $client The Guzzle client (might be mocked, so accept interface)
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Submit an HTTP GET request
     *
     * @param Url $url The url to send the request to $uri
     * @param array $headers A key/value pair array of headers to send with the request
     *
     * @return ResponseInterface The HTTP response (PSR implementation)
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(UriInterface $url, array $headers = [])
    {
        $result = $this->getClient()->send(
            new Request('GET', $url, $headers), [
                'http_errors' => false,
            ]
        );

        return $this->response($result);
    }

    /**
     * Submit an HTTP POST request
     *
     * @param Url $url The url to send the request to $uri
     * @param array $headers A key/value pair array of headers to send with the request
     * @param string $payload The payload to send with the request
     *
     * @return ResponseInterface The HTTP response (PSR implementation)
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(UriInterface $url, array $headers = [], $payload = '')
    {
        $result = $this->getClient()->send(
            new Request('POST', $url, $headers, $payload), [
                'http_errors' => false,
            ]
        );

        return $this->response($result);
    }

    /**
     * Submit an HTTP DELETE request
     *
     * @param Url $url The url to send the request to $uri
     * @param array $headers A key/value pair array of headers to send with the request
     *
     * @return ResponseInterface The HTTP response (PSR implementation)
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(UriInterface $url, array $headers = [])
    {
        $result = $this->getClient()->send(
            new Request('DELETE', $url, $headers), [
                'http_errors' => false,
            ]
        );

        return $this->response($result);
    }

    /**
     * Submit an HTTP PATCH request
     *
     * @param Url $url The url to send the request to $uri
     * @param array $headers A key/value pair array of headers to send with the request
     * @param string $payload The payload to send with the request
     *
     * @return ResponseInterface The HTTP response (PSR implementation)
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function patch(UriInterface $url, array $headers = [], $payload = '')
    {
        $result = $this->getClient()->send(
            new Request('PATCH', $url, $headers, $payload), [
                'http_errors' => false,
            ]
        );

        return $this->response($result);
    }

    ########################################################
    #                                                      #
    #          P R O T E C T E D    M E T H O D S          #
    #                                                      #
    ########################################################

    // No protected methods

    ########################################################
    #                                                      #
    #            P R I V A T E    M E T H O D S            #
    #                                                      #
    ########################################################

    /**
     * Get the current Guzzle Client
     *
     * @return ClientInterface
     */
    private function getClient()
    {
        return $this->client;
    }

    /**
     * Returns a new Psr Response object
     *
     * @return Response
     */
    private function response(\GuzzleHttp\Message\Response $result)
    {
        return new Response($result->getStatusCode(), $result->getHeaders(), $result->getBody());
    }
}
