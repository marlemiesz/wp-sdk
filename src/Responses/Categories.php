<?php

namespace Marlemiesz\WpSDK\Responses;

class Categories extends Response
{
    
    /**
     * @throws \Exception
     */
    public function validate(): bool
    {
        foreach($this->items as $item) {
            if(!$item instanceof \Marlemiesz\WpSDK\Entities\Category) {
                throw new \Exception('All posts must be instance of Marlemiesz\WpSDK\Entities\Category');
            }
        }
        return true;
    }
}

