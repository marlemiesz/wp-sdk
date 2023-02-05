<?php

namespace Marlemiesz\WpSDK\Requests;

interface WpRequestInterface
{
    public function getMethod(): string;
    public function getEndpoint(): string;
    public function getPayload(): PayloadInterface|null;
    
}
