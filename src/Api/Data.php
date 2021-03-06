<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Data Context.
 */
class Data extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'data';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'types';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'data';

    /**
     * Get a single item.
     *
     * @param int   $id
     * @param array $options
     *
     * @return array|mixed
     */
    public function get($id, $options = [])
    {
        return $this->makeRequest("{$this->endpoint}/$id", $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishedList($search = '', $start = 0, $limit = 0, $orderBy = '', $orderByDir = 'ASC')
    {
        return $this->actionNotSupported(__FUNCTION__);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $parameters)
    {
        return $this->actionNotSupported(__FUNCTION__);
    }

    /**
     * {@inheritdoc}
     */
    public function edit($id, array $parameters, $createIfNotExists = false)
    {
        return $this->actionNotSupported(__FUNCTION__);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        return $this->actionNotSupported(__FUNCTION__);
    }
}
