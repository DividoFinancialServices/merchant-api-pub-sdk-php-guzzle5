<?php

namespace Divido\MerchantSDKGuzzle5;

use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Url;

interface IHttpClient
{
    /**
     * Submit an HTTP GET request
     *
     * @param Url $url The url to send the request to $uri
     * @param array $headers A key/value pair array of headers to send with the request
     *
     * @return ResponseInterface The HTTP response (PSR implementation)
     */
    public function get(Url $url, array $headers = []);

    /**
     * Submit an HTTP POST request
     *
     * @param Url $url The url to send the request to $uri
     * @param array $headers A key/value pair array of headers to send with the request
     * @param string $payload The payload to send with the request
     *
     * @return ResponseInterface The HTTP response (PSR implementation)
     */
    public function post(Url $url, array $headers = [], $payload = '');

    /**
     * Submit an HTTP DELETE request
     *
     * @param Url $url The url to send the request to $uri
     * @param array $headers A key/value pair array of headers to send with the request
     *
     * @return ResponseInterface The HTTP response (PSR implementation)
     */
    public function delete(Url $url, array $headers = []);

    /**
     * Submit an HTTP PATCH request
     *
     * @param Url $url The url to send the request to $uri
     * @param array $headers A key/value pair array of headers to send with the request
     * @param string $payload The payload to send with the request
     *
     * @return ResponseInterface The HTTP response (PSR implementation)
     */
    public function patch(Url $url, array $headers = [], $payload = '');
}
