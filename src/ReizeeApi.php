<?php

/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api;

use Reizee\Api\Auth\ApiAuth;
use Reizee\Api\Auth\AuthInterface;
use Reizee\Api\Exception\ContextNotFoundException;

/**
 * Reizee\Api\ReizeeApi API Factory.
 */
class ReizeeApi
{

    private $config;
    private $version;

    const CONTEXT_CONTACT = 'contacts';
    const CONTEXT_COMPANY = 'companies';

    public function __construct(string $version, array $config)
    {
        $this->config = $config;
        $this->version = $version;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function authenticate()
    {
        // Initiate the auth object
        $initAuth = new ApiAuth();

        return  $initAuth->newAuth($this->getConfig(), $this->getVersion() === 'BasicAuth' ? $this->getVersion() : 'OAuth');
    }


    /**
     * Get an API context object.
     *
     * @param string        $apiContext API context (leads, forms, etc)
     * @param AuthInterface $auth       API Auth object
     * @param string        $baseUrl    Base URL for API endpoints
     *
     * @return Api\Api
     *
     * @throws ContextNotFoundException
     *
     * @deprecated
     */
    public static function getContext($apiContext, AuthInterface $auth, $baseUrl = '')
    {
        static $contexts = [];

        // if(!empty$config['baseUrl'])

        $apiContext = ucfirst($apiContext);

        if (!isset($context[$apiContext])) {
            $class = 'Reizee\Api\\Api\\' . $apiContext;

            if (!class_exists($class)) {
                throw new ContextNotFoundException("A context of '$apiContext' was not found.");
            }

            $contexts[$apiContext] = new $class($auth, $baseUrl);
        }

        return $contexts[$apiContext];
    }

    /**
     * Get an API context object.
     *
     * @param string        $apiContext API context (leads, forms, etc)
     * @param AuthInterface $auth       API Auth object
     * @param string        $baseUrl    Base URL for API endpoints
     *
     * @return Api\Api
     *
     * @throws ContextNotFoundException
     */
    public function newApi($apiContext, AuthInterface $auth, $baseUrl = '')
    {
        $apiContext = ucfirst($apiContext);

        $class = 'Reizee\Api\\Api\\' . $apiContext;

        if (!$baseUrl) {
            $baseUrl = $this->getConfig()['baseUrl'] . '/api/';
        }

        if (!class_exists($class)) {
            throw new ContextNotFoundException("A context of '$apiContext' was not found.");
        }

        return new $class($auth, $baseUrl);
    }
}
