<?php

namespace Marlemiesz\WpSDK\Requests;

use Marlemiesz\WpSDK\Entities\Post;
use Marlemiesz\WpSDK\Requests\Payloads\PostPayload;
use Marlemiesz\WpSDK\Responses\Posts;

class UpdatePosts implements WpRequestInterface
{
    const METHOD = 'POST';
    
    const ENDPOINT = '/wp-json/wp/v2/posts/%d';
    
    private PostPayload $postPayload;
    
    public function __construct(
        readonly int $id,
        string $title,
        string $content,
        string    $status,
        array    $categories,
    ) {
        $this->postPayload = new PostPayload(
            $title,
            $content,
            $status,
            $categories,
        );
    }
    
    public function getMethod(): string
    {
        return self::METHOD;
    }
    
    public function getEndpoint(): string
    {
        return sprintf(self::ENDPOINT, $this->id);
    }
    
    public function getPayload(): PostPayload|null
    {
        return $this->postPayload;
    }
    
    public function prepareResponse(array $item): Posts
    {
        $posts = [];
        $posts[] = Post::fromPrimitive($item);
        return new Posts($posts);
    }
}
