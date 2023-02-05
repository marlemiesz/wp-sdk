<?php

namespace Marlemiesz\WpSDK\HttpClients;

use Marlemiesz\WpSDK\Utils;

/**
 * @property \GuzzleHttp\Client $httpConnection
 */
readonly class Client
{
   
    
    public function __construct(private string $wp_url, private string $wp_user, private string $wp_password)
    {
        $this->httpConnection = new \GuzzleHttp\Client([
            'base_uri' => $this->wp_url,
            'headers'  => [
                'Content-Type' => 'application/json',
                'Authorization'     => Utils::base64Encode($this->wp_user, $this->wp_password),
            ]
        ]);
    }
    
    public function call(string $method, string $endpoint, array $data = []): array
    {
        $response = $this->httpConnection->request($method, $endpoint, [
            'json' => $data
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }
    
    /**
     * @return string
     */
    public function getWpUrl(): string
    {
        return $this->wp_url;
    }
    
    /**
     * @return string
     */
    public function getWpUser(): string
    {
        return $this->wp_user;
    }
    
    /**
     * @return string
     */
    public function getWpPassword(): string
    {
        return $this->wp_password;
    }
}
