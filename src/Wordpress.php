<?php
namespace Marlemiesz\WpSDK;
use Marlemiesz\WpSDK\HttpClients\Client;
use Marlemiesz\WpSDK\Responses\Categories;
use Marlemiesz\WpSDK\Responses\Posts;

class Wordpress
{
    protected Client $client;
    
    public function __construct(string $wp_url, string $wp_user, string $wp_password)
    {
        $this->client = new Client($wp_url, $wp_user, $wp_password);
    }
    
    public function getPosts(): Posts
    {
        return $this->client->call(new Requests\GetPosts());
    }
    
    public function getCategories(): Categories
    {
        return $this->client->call(new Requests\GetCategories());
    }
}
