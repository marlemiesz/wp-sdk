<?php

namespace Marlemiesz\WpSDK\HttpClients;

use Marlemiesz\WpSDK\Requests\WpRequestInterface;
use Marlemiesz\WpSDK\Utils;


readonly class Client
{
    
    
    private \GuzzleHttp\Client $httpConnection;
    
    public function __construct(private string $wp_url, private string $wp_user, private string $wp_password)
    {
        $this->httpConnection = new \GuzzleHttp\Client([
            'base_uri' => $this->wp_url,
            'headers'  => [
                'Content-Type' => 'application/json',
                'Authorization'     => $this->getAuthorization(),
            ]
        ]);
    }
    
    public function call(WpRequestInterface $wpRequest): array
    {
        $response = $this->httpConnection->request($wpRequest->getMethod(), $wpRequest->getEndpoint(), [
            'json' => $wpRequest->getPayload()?->toPrimitive()
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
    
    /**
     * @return string
     */
    protected function getAuthorization(): string
    {
        return sprintf("Basic %s", Utils::base64Encode($this->wp_user, ':', $this->wp_password));
    }
}
