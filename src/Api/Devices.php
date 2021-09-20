<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Devices Context.
 */
class Devices extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'devices';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'devices';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'device';
}
