<?php
namespace Marlemiesz\WpSDK;
use GuzzleHttp\Exception\GuzzleException;
use Marlemiesz\WpSDK\Entities\Post;
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
    
    /**
     * @throws GuzzleException
     */
    public function getPosts(): Posts
    {
        return $this->client->call(new Requests\GetPosts());
    }
    
    /**
     * @throws GuzzleException
     */
    public function getCategories(): Categories
    {
        return $this->client->call(new Requests\GetCategories());
    }
    
    public function addPost(
        string $title,
        string $content,
        string    $status,
        array    $categories,
    ): Posts
    {
        return $this->client->call(new Requests\AddPosts($title, $content, $status, $categories ));
    }
    
    public function updatePost(
        int $id,
        string $title,
        string $content,
        string    $status,
        array    $categories,
    ): Posts
    {
        return $this->client->call(new Requests\UpdatePosts($id, $title, $content, $status, $categories ));
    }
}
