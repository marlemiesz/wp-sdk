<?php

namespace Marlemiesz\WpSDK\Requests\Payloads;

class PostPayload implements PayloadInterface
{
    //Prapare payload for POST wp api post request
    public function __construct(
        private readonly string $title,
        private readonly string $content,
        private readonly string    $status,
        private readonly array    $categories,
    ) {
    }
    
    public function fromPrimitive(array $data): PayloadInterface
    {
        return new PostPayload(
            $data['title'],
            $data['content'],
            $data['status'],
            $data['categories'],
        );
    }
    
    public function toPrimitive(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'categories' => $this->categories,
        ];
    }
}
