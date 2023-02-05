<?php

namespace Marlemiesz\WpSDK;

class Utils
{
    public static function base64Encode(string ...$strings): string
    {
        return base64_encode(implode('', $strings));
    }
}
