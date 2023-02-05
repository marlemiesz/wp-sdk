<?php

namespace Marlemiesz\WpSDK\Requests;

class GetPosts implements WpRequestInterface
{
    const METHOD = 'GET';
    
    const ENDPOINT = '/wp-json/wp/v2/posts';
    public function getMethod(): string
    {
        return self::METHOD;
    }
    
    public function getEndpoint(): string
    {
        return self::ENDPOINT;
    }
    
    public function getPayload(): PayloadInterface|null
    {
        return null;
    }
}
