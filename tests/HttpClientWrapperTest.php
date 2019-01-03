<?php

namespace Divido\MerchantSDKGuzzle5\Test;

use Divido\MerchantSDKGuzzle5\GuzzleAdapter;
use Divido\MerchantSDKGuzzle5\HttpClientWrapper;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Url;
use PHPUnit\Framework\TestCase;

class HttpClientWrapperTest extends TestCase
{
    public function test_DoIt()
    {
        $mock_Client = \Mockery::spy(Guzzle::class);

        $baseUrl = 'https://merchant-api-testing-divido-foo';
        $apiKey = 'foo';
        $path = '/applications';

        list($scheme, $host) = explode('://', $baseUrl);
        $url = new Url($scheme, $host);
        $url->setPath($path . (empty($query) ? '' : '?' . http_build_query($query, '', '&')));

        $request = new Request('GET', $url, ['X-Divido-Api-Key' => $apiKey]);

        $mock_Client->shouldReceive('send')
            ->once()
            ->with($request, ['http_errors' => false]);

        $httpClientWrapper = new HttpClientWrapper(
            new GuzzleAdapter($mock_Client),
            $baseUrl,
            $apiKey
        );

        $httpClientWrapper->request('get', $path);
    }
}
