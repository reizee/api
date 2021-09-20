<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Roles Context.
 */
class Roles extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'roles';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'roles';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'role';

    /**
     * {@inheritdoc}
     */
    protected $searchCommands = [
        'ids',
        'is:admin',
        'name',
    ];
}
