<?php

/*
 * @copyright   2021 Reizee Contributors. All rights reserved
 * @author      Reizee\Api\ReizeeApi, Inc.
 *
 * @link        https://reizee.com.br
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Reizee\Api\Auth;

/**
 * OAuth Client modified from https://code.google.com/p/simple-php-oauth/.
 */
class ApiAuth
{
    /**
     * Get an API Auth object.
     *
     * @param array  $parameters
     * @param string $authMethod
     *
     * @return AuthInterface
     */
    public function newAuth($parameters = [], $authMethod = 'OAuth')
    {
        $class      = 'Reizee\Api\\Auth\\'.$authMethod;
        $authObject = new $class();

        $reflection = new \ReflectionMethod($class, 'setup');
        $pass       = [];

        foreach ($reflection->getParameters() as $param) {
            if (isset($parameters[$param->getName()])) {
                $pass[] = $parameters[$param->getName()];
            } else {
                $pass[] = null;
            }
        }

        $reflection->invokeArgs($authObject, $pass);

        return $authObject;
    }
}
