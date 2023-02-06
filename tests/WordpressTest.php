<?php


use Marlemiesz\WpSDK\Wordpress;
use PHPUnit\Framework\TestCase;

/**
 * @property Wordpress $wp_sdk
 */
final class WordpressTest extends TestCase
{
    const envFile = __DIR__ . '/../.env.test';
    private function validateEnv(): void
    {
        if(!file_exists(self::envFile)) {
            $this->markTestSkipped('No .env file found');
        }
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.test');
        $dotenv->load();
        if(!isset($_ENV['WP_URL']) || !isset($_ENV['WP_USER']) || !isset($_ENV['WP_PASSWORD'])) {
            $this->markTestSkipped('Please set WP_URL, WP_USER and WP_PASSWORD in your .env file');
        }
    }
    public function setUp(): void
    {
        parent::setUp();
        $this->validateEnv();
        $this->wp_sdk = new Wordpress($_ENV['WP_URL'], $_ENV['WP_USER'], $_ENV['WP_PASSWORD']);
    }
    
    public function testGetPosts()
    {
        $item = $this->wp_sdk->getPosts()?->getFirstItem();
        
        $this->assertIsInt($item->getId());
        $this->assertIsString($item->getTitle());
        $this->assertIsString($item->getContent());
        $this->assertIsString($item->getExcerpt());
        $this->assertIsString($item->getSlug());
        $this->assertIsString($item->getLink());
    
        $this->assertNotEmpty($item->getId());
        $this->assertNotEmpty($item->getTitle());
        $this->assertNotEmpty($item->getContent());
        $this->assertNotEmpty($item->getExcerpt());
        $this->assertNotEmpty($item->getSlug());
        $this->assertNotEmpty($item->getLink());
        
    }
    
    public function testGetCategories()
    {
        $item = $this->wp_sdk->getCategories()?->getFirstItem();
        
        $this->assertIsInt($item->getId());
        $this->assertIsString($item->getName());
        $this->assertIsString($item->getSlug());
        $this->assertIsString($item->getLink());
    
        $this->assertNotEmpty($item->getId());
        $this->assertNotEmpty($item->getName());
        $this->assertNotEmpty($item->getSlug());
        $this->assertNotEmpty($item->getLink());
        
    }
    
    public function testAddPost()
    {
        $item = $this->wp_sdk->addPost(
            'Test title',
            'Test content',
            \Marlemiesz\WpSDK\Enum\PostStatuses::PUBLISH,
            [1],
        )?->getFirstItem();
        
        $this->assertIsInt($item->getId());
        $this->assertIsString($item->getTitle());
        $this->assertIsString($item->getContent());
        $this->assertIsString($item->getExcerpt());
        $this->assertIsString($item->getSlug());
        $this->assertIsString($item->getLink());
    
        $this->assertNotEmpty($item->getId());
        $this->assertNotEmpty($item->getTitle());
        $this->assertNotEmpty($item->getContent());
        $this->assertNotEmpty($item->getExcerpt());
        $this->assertNotEmpty($item->getSlug());
        $this->assertNotEmpty($item->getLink());
        
    }
}
