<?php


use Marlemiesz\WpSDK\Wordpress;
use PHPUnit\Framework\TestCase;

/**
 * @property Wordpress $wp_sdk
 */
final class WordpressTest extends TestCase
{
    const envFile = __DIR__ . '/../.env.test';
    
    const title = 'Test title';
    const content = 'Test content';
    const status = \Marlemiesz\WpSDK\Enum\PostStatuses::PUBLISH;
    
    const updateTitle = 'Test title updated';
    const updateContent = 'Test content updated';
    const updateStatus = \Marlemiesz\WpSDK\Enum\PostStatuses::DRAFT;
    
    
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
        $item = $this->addPost();
    
        $this->validPostStructure($item);
        
        $this->assertEquals(self::title, $item->getTitle());
        $this->assertEquals(self::status, $item->getStatus());
    
    
        $this->deletePost($item);
        
    }
    
    public function testUpdatePost()
    {
        $item = $this->addPost();
        $item = $this->updatePost($item);
        
        $this->validPostStructure($item);
        
        $this->assertEquals(self::updateTitle, $item->getTitle());
        $this->assertEquals(self::updateStatus, $item->getStatus());
        $this->deletePost($item);
        
    }
    
    public function testDeletePost()
    {
        $item = $this->addPost();
        $item = $this->deletePost($item);
        $this->assertNull($item);
        
    }
    
    private function deletePost(\Marlemiesz\WpSDK\Entities\Post $post): void
    {
        $this->wp_sdk->deletePost($post->getId());
    }
    
    private function addPost(): \Marlemiesz\WpSDK\Entities\Post
    {
        return $this->wp_sdk->addPost(
            self::title,
            self::content,
            self::status,
            [1],
        )?->getFirstItem();
    }
    
    private function updatePost(\Marlemiesz\WpSDK\Entities\Post $post): \Marlemiesz\WpSDK\Entities\Post
    {
        return $this->wp_sdk->updatePost(
            $post->getId(),
            self::updateTitle,
            self::updateContent,
            self::updateStatus,
            [1],
        )?->getFirstItem();
    }
    
    private function validPostStructure(\Marlemiesz\WpSDK\Entities\Post $post): void
    {
        $this->assertIsInt($post->getId());
        $this->assertIsString($post->getTitle());
        $this->assertIsString($post->getContent());
        $this->assertIsString($post->getExcerpt());
        $this->assertIsString($post->getSlug());
        $this->assertIsString($post->getLink());
        
        $this->assertNotEmpty($post->getId());
        $this->assertNotEmpty($post->getTitle());
        $this->assertNotEmpty($post->getContent());
        $this->assertNotEmpty($post->getExcerpt());
        $this->assertNotEmpty($post->getSlug());
        $this->assertNotEmpty($post->getLink());
    }
}
