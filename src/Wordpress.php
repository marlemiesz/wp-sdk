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
    
    /**
     * @param string $wp_url
     * @param string $wp_user
     * @param string $wp_password
     */
    public function __construct(string $wp_url, string $wp_user, string $wp_password)
    {
        $this->client = new Client($wp_url, $wp_user, $wp_password);
    }
    
    
    /**
     * @return Posts
     * @throws GuzzleException
     */
    public function getPosts(): Posts
    {
        return $this->client->call(new Requests\GetPosts());
    }
    
    
    /**
     * @return Categories
     * @throws GuzzleException
     */
    public function getCategories(): Categories
    {
        return $this->client->call(new Requests\GetCategories());
    }
    
    /**
     * @param string $title
     * @param string $content
     * @param string $status
     * @param array $categories
     * @return Posts
     * @throws GuzzleException
     */
    public function addPost(
        string $title,
        string $content,
        string    $status,
        array    $categories,
    ): Posts
    {
        return $this->client->call(new Requests\AddPost($title, $content, $status, $categories ));
    }
    
    /**
     * @param int $id
     * @param string $title
     * @param string $content
     * @param string $status
     * @param array $categories
     * @return Posts
     * @throws GuzzleException
     */
    public function updatePost(
        int $id,
        string $title,
        string $content,
        string    $status,
        array    $categories,
    ): Posts
    {
        return $this->client->call(new Requests\UpdatePost($id, $title, $content, $status, $categories ));
    }
    
    /**
     * @param int $id
     * @return Posts
     * @throws GuzzleException
     */
    public function deletePost(int $id): Posts
    {
        return $this->client->call(new Requests\DeletePost($id));
    }
}
