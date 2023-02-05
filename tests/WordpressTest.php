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
        var_dump($this->wp_sdk->getPosts());exit;
    }
}
