<?php

namespace Divido\MerchantSDKGuzzle5\Test;

use Divido\MerchantSDKGuzzle5\GuzzleAdapter;
use Divido\MerchantSDK\HttpClient\Uri;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Stream\Stream;

class HttpClientWrapperTest extends TestCase
{
    public function test_GuzzleAdapter_GetRequest_ReturnsBody()
    {
        $baseUrl = 'https://merchant-api-testing-divido-foo';
        $apiKey = 'foo';
        $path = '/applications';
        $query = [];

        $uri = new Uri($baseUrl . $path . (empty($query) ? '' : '?' . http_build_query($query, '', '&')));
        $request = new Request('GET', $uri, ['X-Divido-Api-Key' => $apiKey]);

        $payload = Stream::factory('{"foo":"bar"}');

        $mock_Client = \Mockery::spy(Guzzle::class);
        $mock_Client->shouldReceive('send')
            ->once()
            // ->with($request, ['http_errors' => false])
            ->andReturn(new Response(200, [], $payload));

        $guzzleAdapter = new GuzzleAdapter($mock_Client);
        $result = $guzzleAdapter->get($uri, ['X-Divido-Api-Key' => $apiKey]);

        $this->assertEquals(200, $result->getStatusCode());
        $this->assertEquals('{"foo":"bar"}', $result->getBody()->getContents());
    }

    public function test_GuzzleAdapter_PostRequest_ReturnsBody()
    {
        $baseUrl = 'https://merchant-api-testing-divido-foo';
        $apiKey = 'foo';
        $path = '/applications';
        $query = [];

        $uri = new Uri($baseUrl . $path . (empty($query) ? '' : '?' . http_build_query($query, '', '&')));
        $payload = Stream::factory('{"foo":"bar"}');
        $request = new Request('POST', $uri, ['X-Divido-Api-Key' => $apiKey], $payload);

        $mock_Client = \Mockery::spy(Guzzle::class);
        $mock_Client->shouldReceive('send')
            ->once()
            // ->with($request, ['http_errors' => false])
            ->andReturn(new Response(201, [], $payload));

        $guzzleAdapter = new GuzzleAdapter($mock_Client);
        $result = $guzzleAdapter->post($uri, ['X-Divido-Api-Key' => $apiKey], '{"foo":"bar"}');

        $this->assertEquals(201, $result->getStatusCode());
        $this->assertEquals('{"foo":"bar"}', $result->getBody()->getContents());
    }

    public function test_GuzzleAdapter_DeleteRequest_ReturnsBody()
    {
        $baseUrl = 'https://merchant-api-testing-divido-foo';
        $apiKey = 'foo';
        $path = '/applications/1';
        $query = [];

        $uri = new Uri($baseUrl . $path . (empty($query) ? '' : '?' . http_build_query($query, '', '&')));
        $request = new Request('POST', $uri, ['X-Divido-Api-Key' => $apiKey], null);

        $mock_Client = \Mockery::spy(Guzzle::class);
        $mock_Client->shouldReceive('send')
            ->once()
            // ->with($request, ['http_errors' => false])
            ->andReturn(new Response(200, [], null));

        $guzzleAdapter = new GuzzleAdapter($mock_Client);
        $result = $guzzleAdapter->delete($uri, ['X-Divido-Api-Key' => $apiKey]);

        $this->assertEquals(200, $result->getStatusCode());
    }

    public function test_GuzzleAdapter_PatchRequest_ReturnsBody()
    {
        $baseUrl = 'https://merchant-api-testing-divido-foo';
        $apiKey = 'foo';
        $path = '/applications/1';
        $query = [];

        $uri = new Uri($baseUrl . $path . (empty($query) ? '' : '?' . http_build_query($query, '', '&')));
        $payload = Stream::factory('{"foo":"bar"}');
        $request = new Request('PATCH', $uri, ['X-Divido-Api-Key' => $apiKey], $payload);

        $mock_Client = \Mockery::spy(Guzzle::class);
        $mock_Client->shouldReceive('send')
            ->once()
            // ->with($request, ['http_errors' => false])
            ->andReturn(new Response(200, [], $payload));

        $guzzleAdapter = new GuzzleAdapter($mock_Client);
        $result = $guzzleAdapter->patch($uri, ['X-Divido-Api-Key' => $apiKey], '{"foo":"bar"}');

        $this->assertEquals(200, $result->getStatusCode());
        $this->assertEquals('{"foo":"bar"}', $result->getBody()->getContents());
    }
}
