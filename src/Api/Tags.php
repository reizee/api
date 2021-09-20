<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Tags Context.
 */
class Tags extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'tags';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'tags';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'tag';
}
