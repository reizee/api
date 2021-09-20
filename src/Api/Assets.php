<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Assets Context.
 */
class Assets extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'assets';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'assets';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'asset';

    /**
     * {@inheritdoc}
     */
    protected $searchCommands = [
        'ids',
        'is:published',
        'is:unpublished',
        'is:mine',
        'is:uncategorized',
        'category',
    ];
}
