<?php
namespace Marlemiesz\WpSDK;
use Marlemiesz\WpSDK\HttpClients\Client;

class Wordpress
{
    protected Client $client;
    
    public function __construct(string $wp_url, string $wp_user, string $wp_password)
    {
        $this->client = new Client($wp_url, $wp_user, $wp_password);
    }
    
    public function getPosts(): array
    {
        return $this->client->call(new Requests\GetPosts());
    }
}
