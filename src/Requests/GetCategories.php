<?php

namespace Marlemiesz\WpSDK\Requests;

use Marlemiesz\WpSDK\Entities\Category;
use Marlemiesz\WpSDK\Entities\Post;
use Marlemiesz\WpSDK\Requests\PayloadInterface;
use Marlemiesz\WpSDK\Responses\Categories;
use Marlemiesz\WpSDK\Responses\Posts;

class GetCategories implements WpRequestInterface
{
    const METHOD = 'GET';
    
    const ENDPOINT = '/wp-json/wp/v2/categories';
    public function getMethod(): string
    {
        return self::METHOD;
    }
    
    public function getEndpoint(): string
    {
        return self::ENDPOINT;
    }
    
    public function getPayload(): null
    {
        return null;
    }
    
    public function prepareResponse(array $items): Categories
    {
        $posts = [];
        if(count($items) > 0) {
            foreach($items as $item) {
                $posts[] = Category::fromPrimitive($item);
            }
        }
        return new Categories($posts);
    }
}
