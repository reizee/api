<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Tweets Context.
 */
class Tweets extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'tweets';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'tweets';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'tweet';

    /**
     * {@inheritdoc}
     */
    protected $searchCommands = [];
}
