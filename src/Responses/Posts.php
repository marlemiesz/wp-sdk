<?php

namespace Marlemiesz\WpSDK\Responses;

class Posts extends Response
{
    
    /**
     * @throws \Exception
     */
    public function validate(): bool
    {
        foreach($this->posts as $post) {
            if(!$post instanceof \Marlemiesz\WpSDK\Entities\Post) {
                throw new \Exception('All posts must be instance of Marlemiesz\WpSDK\Entities\Post');
            }
        }
        return true;
    }
}

