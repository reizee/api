<?php
/*
 * @package     Reizee\Api\ReizeeApi
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 * @link        http://mautic.org
 
 */

namespace Reizee\Api\Api;

/*
 * Emails Context
 */
class Focus extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'focus';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'focus';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'focus';

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
