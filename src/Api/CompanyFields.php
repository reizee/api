<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * CompanyFields Context.
 */
class CompanyFields extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'fields/company';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'fields';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'field';
}
