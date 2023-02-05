<?php

namespace Marlemiesz\WpSDK\HttpClients;

use GuzzleHttp\Exception\GuzzleException;
use Marlemiesz\WpSDK\Requests\WpRequestInterface;
use Marlemiesz\WpSDK\Responses\ResponseInterface;
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
    
    /**
     * @param WpRequestInterface $wpRequest
     * @return array
     * @throws GuzzleException
     * @throws \Exception
     */
    public function call(WpRequestInterface $wpRequest): ResponseInterface
    {
        $response = $this->httpConnection->request($wpRequest->getMethod(), $wpRequest->getEndpoint(), [
            'json' => $wpRequest->getPayload()?->toPrimitive()
        ]);
        $this->validResponse($response);
        return $wpRequest->prepareResponse(json_decode($response->getBody()->getContents(), true));
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
    
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return void
     * @throws \Exception
     */
    protected function validResponse(\Psr\Http\Message\ResponseInterface $response): void
    {
        if ($response->getStatusCode() !== 200) {
            throw new \Exception($response->getBody()->getContents(), $response->getStatusCode());
        }
    }
}
