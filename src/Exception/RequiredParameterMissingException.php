<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Exception;

/**
 * Exception representing a required parameter is missing for Basic Authentication.
 */
class RequiredParameterMissingException extends AbstractApiException
{
    /**
     * {@inheritdoc}
     */
    const DEFAULT_MESSAGE = 'Required Parameter is missing.';
}
