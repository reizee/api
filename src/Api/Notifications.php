<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Notifications Context.
 */
class Notifications extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'notifications';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'notifications';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'notification';

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
        'lang',
    ];
}
