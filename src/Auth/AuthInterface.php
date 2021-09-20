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

interface AuthInterface
{
    /**
     * Check if current authorization is still valid.
     *
     * @return bool
     */
    public function isAuthorized();

    /**
     * Make a request to server using the supported auth method.
     *
     * @param string $url
     * @param string $method
     *
     * @return array
     */
    public function makeRequest($url, array $parameters = [], $method = 'GET', array $settings = []);
}
