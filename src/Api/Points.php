<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Points Context.
 */
class Points extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'points';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'points';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'point';

    /**
     * {@inheritdoc}
     */
    protected $searchCommands = [
        'ids',
    ];

    /**
     * Get list of available action types.
     *
     * @return array|mixed
     */
    public function getPointActionTypes()
    {
        return $this->makeRequest($this->endpoint.'/actions/types');
    }
}
