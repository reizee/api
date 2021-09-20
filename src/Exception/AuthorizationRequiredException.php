<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Exception;

class AuthorizationRequiredException extends \Exception
{
    /**
     * @var string
     */
    private $authUrl;

    /**
     * AuthorizationRequiredException constructor.
     *
     * @param string $authUrl
     *                        {@inheritdoc}
     */
    public function __construct($authUrl, $message = 'Authorization is required.', $code = 401, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->authUrl = $authUrl;
    }

    /**
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->authUrl;
    }
}
