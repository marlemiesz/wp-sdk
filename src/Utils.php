<?php

namespace Marlemiesz\WpSDK;

class Utils
{
    public static function base64Encode(strings ...$strings): string
    {
        return base64_encode(implode('', $strings));
    }
}
