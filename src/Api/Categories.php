<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Categories Context.
 */
class Categories extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'categories';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'categories';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'category';

    /**
     * {@inheritdoc}
     */
    protected $searchCommands = [
        'ids',
        'is:published',
        'is:unpublished',
    ];
}
