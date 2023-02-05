<?php

namespace Marlemiesz\WpSDK\Requests\Payloads;

interface PayloadInterface
{
    public function fromPrimitive(array $data): PayloadInterface;
    public function toPrimitive(): array;
}
