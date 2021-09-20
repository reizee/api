<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Exception;

/**
 * Abstract Exception class with common behavour - DRY implementation.
 */
abstract class AbstractApiException extends \Exception
{
    /**
     * The default message to be used if a specific message is not provided.
     * Note: Overriden in subclass.
     */
    const DEFAULT_MESSAGE = 'Unknown Error';

    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 500, \Exception $previous = null)
    {
        if (empty($message)) {
            // Use message appropriate to the subclass with late binding
            $message = static::DEFAULT_MESSAGE;
        }

        parent::__construct($message, $code, $previous);
    }
}
