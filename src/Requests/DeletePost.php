<?php

namespace Marlemiesz\WpSDK\Requests;

use Marlemiesz\WpSDK\Entities\Post;
use Marlemiesz\WpSDK\Requests\Payloads\PostPayload;
use Marlemiesz\WpSDK\Responses\Posts;

class DeletePost implements WpRequestInterface
{
    const METHOD = 'DELETE';
    
    const ENDPOINT = '/wp-json/wp/v2/posts/%d';
    
    private PostPayload $postPayload;
    
    public function __construct(
        readonly int $id,
    ) {
    }
    
    public function getMethod(): string
    {
        return self::METHOD;
    }
    
    public function getEndpoint(): string
    {
        return sprintf(self::ENDPOINT, $this->id);
    }
    
    public function getPayload(): null
    {
        return null;
    }
    
    public function prepareResponse(array $item): Posts
    {
        $posts = [];
        return new Posts($posts);
    }
}
