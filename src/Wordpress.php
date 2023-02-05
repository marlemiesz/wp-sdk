<?php
namespace Marlemiesz\WpSDK;
use Marlemiesz\WpSDK\Entities\Client;

class Wordpress
{
    public function __construct(string $wp_url, string $wp_user, string $wp_password)
    {
        $this->client = new Client($wp_url, $wp_user, $wp_password);
    }
}
