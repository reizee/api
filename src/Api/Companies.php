<?php
/**
 * @copyright   2021 Reizee, All  rights reserved.
 * @author      Reizee\Api\ReizeeApi
 *
 * @see        https://reizee.com.br
 */

namespace Reizee\Api\Api;

/**
 * Companies Context.
 */
class Companies extends Api
{
    /**
     * {@inheritdoc}
     */
    protected $endpoint = 'companies';

    /**
     * {@inheritdoc}
     */
    protected $listName = 'companies';

    /**
     * {@inheritdoc}
     */
    protected $itemName = 'company';

    /**
     * @var array
     */
    protected $bcRegexEndpoints = [
        'companies/(.*?)/contact/(.*?)/add'    => 'companies/$1/contact/add/$2', // 2.6.0
        'companies/(.*?)/contact/(.*?)/remove' => 'companies/$1/contact/remove/$2', // 2.6.0
    ];

    /**
     * {@inheritdoc}
     */
    protected $searchCommands = [
        'ids',
        'is:mine',
    ];

    /**
     * Add a contact to the company.
     *
     * @param int $id        Company ID
     * @param int $contactId Contact ID
     *
     * @return array|mixed
     */
    public function addContact($id, $contactId)
    {
        return $this->makeRequest($this->endpoint.'/'.$id.'/contact/'.$contactId.'/add', [], 'POST');
    }

    /**
     * Remove a contact from the company.
     *
     * @param int $id        Company ID
     * @param int $contactId Contact ID
     *
     * @return array|mixed
     */
    public function removeContact($id, $contactId)
    {
        return $this->makeRequest($this->endpoint.'/'.$id.'/contact/'.$contactId.'/remove', [], 'POST');
    }
}
