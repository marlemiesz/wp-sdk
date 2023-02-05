<?php

namespace Marlemiesz\WpSDK\Requests;

use Marlemiesz\WpSDK\Responses\ResponseInterface;

interface WpRequestInterface
{
    public function getMethod(): string;
    public function getEndpoint(): string;
    public function getPayload(): PayloadInterface|null;
    public function prepareResponse(array $items): ResponseInterface;
    
}
