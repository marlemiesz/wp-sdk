<?php

namespace Marlemiesz\WpSDK\Requests;

use Marlemiesz\WpSDK\Entities\Post;
use Marlemiesz\WpSDK\Responses\Posts;

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
    
    public function prepareResponse(array $items): Posts
    {
        $posts = [];
        if(count($items) > 0) {
            foreach($items as $item) {
                $posts[] = Post::fromPrimitive($item);
            }
        }
        return new Posts($posts);
    }
}
