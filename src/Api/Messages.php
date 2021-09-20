<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Marketing Messages Context.
 */
class Messages extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'messages';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'messages';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'message';
}
