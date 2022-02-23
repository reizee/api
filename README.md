# Using the Reizee API library

## Requirements

- PHP 7.2 or newer
- cURL support
- Laravel 6+

## Installing

```bash
composer require reizee/api
```

Publish the config file:

```bash
php artisan vendor:publish --provider="Reizee\Api\ReizeeApiServiceProvider" --tag="config"
```

## Auth

Open the file `config/reizee.php` and configure as the example:

```php
<?php

return [
    'api' => [
        'version' => 'BasicAuth',
        'BasicAuth' => [
            'baseUrl'          => 'https://{DOMAIN}',
            'userName'         => 'USER',
            'password'         => 'PASSWORD',
        ],
    ]
];

```

# How to use

```php
<?php

// Authenticate
$auth = \ReizeeApi::authenticate();

// Init the api Object
$api =  \ReizeeApi::newApi('contacts', $auth);

// Create a contact and return the result
$result = $api->create([
            'email' => 'contato@reizee.com.br',
            'firstname' => 'Reizee',
            'tags' => ['tag-1', 'tag-2'],
            'custom_field_x' => 'custom'
        ]);
...
```
# API

## Contacts
Use this endpoint to manipulate and obtain details on Reizee contacts.

```php
<?php
// Auth
$auth = \ReizeeApi::authenticate();

// Init the api
$api =  \ReizeeApi::newApi('contacts', $auth);
```

### Get Contact
```php
<?php

//...
$contact = $api->get($id);
```
```json
    "contact": {
        "id": 47,
        "dateAdded": "2020-07-21T12:27:12-05:00",
        "createdBy": 1,
        "createdByUser": "Joe Smith",
        "dateModified": "2020-07-21T14:12:03-05:00",
        "modifiedBy": 1,
        "modifiedByUser": "Joe Smith",
        "owner": {
            "id": 1,
            "username": "joesmith",
            "firstName": "Joe",
            "lastName": "Smith"
        },
        "points": 10,
        "lastActive": "2020-07-21T14:19:37-05:00",
        "dateIdentified": "2020-07-21T12:27:12-05:00",
        "color": "ab5959",
        "ipAddresses": {
            "111.111.111.111": {
                "ipAddress": "111.111.111.111",
                "ipDetails": {
                    "city": "",
                    "region": "",
                    "country": "",
                    "latitude": "",
                    "longitude": "",
                    "isp": "",
                    "organization": "",
                    "timezone": ""
                }
            }
        },
        "fields": {
            "core": {
                "title": {
                    "id": "1",
                    "label": "Title",
                    "alias": "title",
                    "type": "lookup",
                    "group": "core",
                    "value": "Mr"
                },
                "firstname": {
                    "id": "2",
                    "label": "First Name",
                    "alias": "firstname",
                    "type": "text",
                    "group": "core",
                    "value": "Jim"
                },

                "...": {
                    "..." : "..."
                }

            },
            "social": {
                "twitter": {
                    "id": "17",
                    "label": "Twitter",
                    "alias": "twitter",
                    "type": "text",
                    "group": "social",
                    "value": "jimcontact"
                },

                "...": {
                    "..." : "..."
                }

            },
            "personal": [],
            "professional": [],
            "all": {
                "title": "Mr",
                "firstname": "Jim",
                "twitter": "jimcontact",

                "...": "..."
            }
        }
    }
```
Get an individual contact by ID.

#### HTTP Request

`GET /contacts/ID`

#### Response

`Expected Response Code: 200`

See JSON code example.

** Contact Properties **

Name|Type|Description
----|----|-----------
id|int|ID of the contact
isPublished|Boolean|True if the contact is published
dateAdded|datetime|Date/time contact was created
createdBy|int|ID of the user that created the contact
createdByUser|string|Name of the user that created the contact
dateModified|datetime/null|Date/time contact was last modified
modifiedBy|int|ID of the user that last modified the contact
modifiedByUser|string|Name of the user that last modified the contact
owner|object|User object that owns the contact.
points|int|Contact's current number of points
lastActive|datetime/null|Date/time for when the contact was last recorded as active
dateIdentified|datetime/null|Date/time when the contact identified themselves
color|string|Hex value given to contact from Point Trigger definitions based on the number of points the contact has been awarded
ipAddresses|array|Array of IPs currently associated with this contact
fields|array|Array of all contact fields with data grouped by field group. See JSON code example for format. This array includes an "all" key that includes an single level array of fieldAlias => contactValue pairs.
tags|array|Array of tags associated with this contact. See JSON code example for format.
utmtags|array|Array of UTM Tags associated with this contact. See JSON code example for format.
doNotContact|array|Array of Do Not Contact objects. See JSON code example for format.

### List Contacts
```php
<?php

//...
$contacts = $api->getList($searchFilter, $start, $limit, $orderBy, $orderByDir, $publishedOnly, $minimal);
```
```json
{
    "total": "1",
    "contacts": {
        "47": {
            "id": 47,
            "isPublished": true,
            "dateAdded": "2020-07-21T12:27:12-05:00",
            "createdBy": 1,
            "createdByUser": "Joe Smith",
            "dateModified": "2020-07-21T14:12:03-05:00",
            "modifiedBy": 1,
            "modifiedByUser": "Joe Smith",
            "owner": {
                "id": 1,
                "username": "joesmith",
                "firstName": "Joe",
                "lastName": "Smith"
            },
            "points": 10,
            "lastActive": "2020-07-21T14:19:37-05:00",
            "dateIdentified": "2020-07-21T12:27:12-05:00",
            "color": "ab5959",
            "ipAddresses": {
                "111.111.111.111": {
                    "ipAddress": "111.111.111.111",
                    "ipDetails": {
                        "city": "",
                        "region": "",
                        "country": "",
                        "latitude": "",
                        "longitude": "",
                        "isp": "",
                        "organization": "",
                        "timezone": ""
                    }
                }
            },
            "fields": {
                "core": {
                    "title": {
                        "id": "1",
                        "label": "Title",
                        "alias": "title",
                        "type": "lookup",
                        "group": "core",
                        "value": "Mr"
                    },
                    "firstname": {
                        "id": "2",
                        "label": "First Name",
                        "alias": "firstname",
                        "type": "text",
                        "group": "core",
                        "value": "Jim"
                    },

                    "...": {
                        "..." : "..."
                    }
                },
                "social": {
                    "twitter": {
                        "id": "17",
                        "label": "Twitter",
                        "alias": "twitter",
                        "type": "text",
                        "group": "social",
                        "value": "jimcontact"
                    },

                    "...": {
                        "..." : "..."
                    }
                },
                "personal": [],
                "professional": [],
                "all": {
                    "title": "Mr",
                    "firstname": "Jim",
                    "twitter": "jimcontact",

                    "...": "..."
                }
            },
            "tags": [{
              "tag": "aTag"
            },
            {
              "tag": "bTag"
            }],
            "utmtags" : [{
              "id": 1,
              "query": {
                "page": "asd",
                "cid": "fb1"
              },
              "referer": "https://example.com/",
              "remoteHost": "example.com",
              "userAgent": "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0",
              "utmCampaign": "abcampaign",
              "utmContent": "page",
              "utmMedium": "social",
              "utmSource": "fb",
              "utmTerm": "test1"
            }],
            "doNotContact": [{
                "id": 2,
                "reason": 2,
                "comments": "",
                "channel": "email",
                "channelId": null
            }]
        }
    }
}
```
Get a list of contacts.

#### HTTP Request

`GET /contacts`

** Query Parameters **

Name|Description
----|-----------
search|String or search command to filter entities by.
start|Starting row for the entities returned. Defaults to 0.
limit|Limit number of entities to return. Defaults to the system configuration for pagination (30).
orderBy|Column to sort by. Can use any column listed in the response. However, all properties in the response that are written in camelCase need to be changed a bit. Before every capital add an underscore `_` and then change the capital letters to non-capital letters. So `dateIdentified` becomes `date_identified`, `modifiedByUser` becomes `modified_by_user` etc.
orderByDir|Sort direction: asc or desc.
publishedOnly|Only return currently published entities.
minimal|Return only array of entities without additional lists in it.
where|An array of advanced where conditions
order|An array of advanced order statements

#### Advanced filtering

In some cases you may want to filter by specific value(s). Use URL params like this:

In PHP:
```php
$where = [
  [
    'col' => 'phone',
    'expr' => 'in',
    'val' => '444444444,888888888',
  ]
];
```
This design allows to add multiple conditions in the same request.

If you are not using PHP, here is URL-encoded example of the above where array:
`GET https://[your_reizee_domain]/api/contacts?where%5B0%5D%5Bcol%5D=phone&where%5B0%5D%5Bexpr%5D=in&where%5B0%5D%5Bval%5D=444444444,888888888`

[List of available expressions](https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/query-builder.html#the-expr-class)

#### Response

`Expected Response Code: 200`

See JSON code example.

** Properties **

Same as [Get Contact](#get-contact).

### Create Contact
```php
<?php

$data = array(
    'firstname' => 'Jim',
    'lastname'  => 'Contact',
    'email'     => 'jim@his-site.com',
    'ipAddress' => $_SERVER['REMOTE_ADDR'],
    'overwriteWithBlank' => true,
);

$contact = $api->create($data);
```
Create a new contact.

#### HTTP Request

`POST /contacts/new`

** Post Parameters **

Name|Description
----|-----------
*|Any contact field alias can be posted as a parameter.  For example, firstname, lastname, email, etc.
ipAddress|IP address to associate with the contact
lastActive|Date/time in UTC; preferablly in the format of Y-m-d H:m:i but if that format fails, the string will be sent through PHP's strtotime then formatted
owner|ID of a Reizee user to assign this contact to
overwriteWithBlank|If true, then empty values are set to fields. Otherwise empty values are skipped

#### Response

`Expected Response Code: 201`

** Properties **

Same as [Get Contact](#get-contact).

### Create Batch Contact
```php
<?php

$data = array(
    array(
	'firstname' => 'Jim',
	'lastname'  => 'Contact',
	'email'     => 'jim@his-site.com',
	'ipAddress' => $_SERVER['REMOTE_ADDR']
    ),
    array(
    	'firstname' => 'John',
	'lastname'  => 'Doe',
	'email'     => 'john@his-site.com',
	'ipAddress' => $_SERVER['REMOTE_ADDR']
    )
);
$contact = $api->createBatch($data);
```
Create a batch of new contacts.

#### HTTP Request

`POST /contacts/batch/new`

** Post Parameters **

Name|Description
----|-----------
*|Any contact field alias can be posted as a parameter.  For example, firstname, lastname, email, etc.
ipAddress|IP address to associate with the contact
lastActive|Date/time in UTC; preferablly in the format of Y-m-d H:m:i but if that format fails, the string will be sent through PHP's strtotime then formatted
owner|ID of a Reizee user to assign this contact to

#### Response

`Expected Response Code: 201`

** Properties **

Array of contacts. Record is the same as [Get Contact](#get-contact).

### Edit Contact
```php
<?php

$id   = 1;
$data = array(
    'email'     => 'jim-new-address@his-site.com',
    'ipAddress' => $_SERVER['REMOTE_ADDR'],    
);

// Create new a contact of ID 1 is not found?
$createIfNotFound = true;

$contact = $api->edit($id, $data, $createIfNotFound);
```
Edit a new contact.  Note that this supports PUT or PATCH depending on the desired behavior.

** PUT ** creates a contact if the given ID does not exist and clears all the contact information, adds the information from the request.
**PATCH** fails if the contact with the given ID does not exist and updates the contact field values with the values form the request.

#### HTTP Request

To edit a contact and return a 404 if the contact is not found:

`PATCH /contacts/ID/edit`

To edit a contact and create a new one if the contact is not found:

`PUT /contacts/ID/edit`

** Post Parameters **

Name|Description
----|-----------
*|Any contact field alias can be posted as a parameter.  For example, firstname, lastname, email, etc.
ipAddress|IP address to associate with the contact
lastActive|Date/time in UTC; preferably in the format of Y-m-d H:m:i but if that format fails, the string will be sent through PHP's strtotime then formatted
owner|ID of a Reizee user to assign this contact to
overwriteWithBlank|If true, then empty values are set to fields. Otherwise empty values are skipped

#### Response

If `PUT`, the expected response code is `200` if the contact was edited or `201` if created.

If `PATCH`, the expected response code is `200`.

** Properties **

Same as [Get Contact](#get-contact).

> Note: In order to remove tag from contact add minus `-` before it.
> For example: `tags: ['one', '-two']`  - sending this in request body will add tag `one` and remove tag `two` from contact.

### Edit Batch Contact
```php
<?php

$data = array(
    array(
        'id'        => 1,
        'firstname' => 'Jim',
        'lastname'  => 'Contact',
        'email'     => 'jim@his-site.com',
        'ipAddress' => $_SERVER['REMOTE_ADDR']
    ),
    array(
        'id'        => 1,
        'firstname' => 'John',
        'lastname'  => 'Doe',
        'email'     => 'john@his-site.com',
        'ipAddress' => $_SERVER['REMOTE_ADDR']
    )
);

$contact = $api->editBatch($data);
```
Edit several contacts in one request.  Note that this supports PUT or PATCH depending on the desired behavior.

**PUT** creates a contact if the given ID does not exist and clears all the contact information, adds the information from the request.
**PATCH** fails if the contact with the given ID does not exist and updates the contact field values with the values form the request.

#### HTTP Request

To edit a contact and return a 404 if the contact is not found:

`PATCH /contacts/batch/edit`

To edit a contact and create a new one if the contact is not found:

`PUT /contacts/batch/edit`

**Post Parameters**

Name|Description
----|-----------
*|Any contact field alias can be posted as a parameter.  For example, firstname, lastname, email, etc.
ipAddress|IP address to associate with the contact
lastActive|Date/time in UTC; preferably in the format of Y-m-d H:m:i but if that format fails, the string will be sent through PHP's strtotime then formatted
owner|ID of a Reizee user to assign this contact to
overwriteWithBlank|If true, then empty values are set to fields. Otherwise empty values are skipped

#### Response

If `PUT`, the expected response code is `200` if the contact was edited or `201` if created.

If `PATCH`, the expected response code is `200`.

**Properties**

Contacts array. Record same as [Get Contact](#get-contact).

> Note: In order to remove tag from contact add minus `-` before it.
> For example: `tags: ['one', '-two']`  - sending this in request body will add tag `one` and remove tag `two` from contact.

### Delete Contact
```php
<?php

$contact = $api->delete($id);
```
Delete a contact.

#### HTTP Request

`DELETE /contacts/ID/delete`

#### Response

`Expected Response Code: 200`

** Properties **

Same as [Get Contact](#get-contact).

### Delete Batch Contact
```php
<?php
$data = array(1, 2);
$contact = $api->deleteBatch($data);
```
Delete contacts.

#### HTTP Request

`DELETE /contacts/batch/delete`

If you are not using PHP, here is a URL example:

`DELETE https://[your_reizee_domain]/api/contacts/batch/delete?ids=1,2`

#### Response

`Expected Response Code: 200`

**Properties**

Contacts array. Record same as [Get Contact](#get-contact).

### Add Do Not Contact
```php
<?php

$api->addDnc($contactId, $channel, $reason, $channelId, $comments);
```

```json
{
  "channelId": "26",
  "reason": "Integration issued DNC",
  "comments": "Unsubscribed via API"
}
```

Add a contact to DNC list

#### HTTP Request

To add Do Not Contact entry to a contact:

`POST /contacts/ID/dnc/CHANNEL/add`

**Data Parameters (optional)**

Name|Description
----|-----------
channel|Channel of DNC. For example 'email', 'sms'... Default is email.
reason|Int value of the reason. Use Contacts constants: Contacts::UNSUBSCRIBED (1), Contacts::BOUNCED (2), Contacts::MANUAL (3). Default is Manual
channelId|ID of the entity which was the reason for unsubscription
comments|A text describing details of DNC entry

#### Response

Same as [Get Contact](#get-contact).

### Remove from Do Not Contact
```php
<?php
$api->removeDnc($contactId, $channel);
```

Remove a contact from DNC list

#### HTTP Request

To remove Do Not Contact entry from a contact:

`POST /contacts/ID/dnc/CHANNEL/remove`

**Data Parameters (optional)**

Name|Description
----|-----------
channel|Channel of DNC. For example 'email', 'sms'... Default is email.

#### Response

Same as [Get Contact](#get-contact).

### Add UTM Tags
```php
<?php

$data = array(
    'utm_campaign' => 'apicampaign',
    'utm_source'   => 'fb',
    'utm_medium'   => 'social',
    'utm_content'  => 'fbad',
    'utm_term'     => 'reizee api',
    'useragent'    => 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0',
    'url'          => '/product/fbad01/',
    'referer'      => 'https://google.com/q=reizee+api',
    'query'        => ['cid'=>'abc','cond'=>'new'], // or as string with "cid=abc&cond=new"
    'remotehost'   => 'example.com',
    'lastActive'   => '2020-01-17T00:30:08+00:00'
 );
$api->addUtm($contactId, $data);
```

Add UTM tags to a contact

#### HTTP Request

To add UTM tag entry to a contact:

`POST /contacts/ID/utm/add`

**UTM Parameters (required)**

While the parameter array is required, each utm tag entry is optional.

Name|Description
----|-----------
utm_campaign|The UTM Campaign parameter
utm_source|The UTM Source parameter
utm_medium|The UTM Medium parameter
utm_content|The UTM Content parameter
utm_term|The UTM Term parameter
useragent|The browsers UserAgent. If provided a new Device entry will be created if necessary.
url|The page url
referer|The URL of the referer,
query|Any extra query parameters you wish to include. Array or http query string
remotehost|The Host name
lastActive|The date that the action occured. Contacts lastActive date will be updated if included. Date format required `2020-01-17T00:30:08+00:00`.

#### Response

Same as [Get Contact](#get-contact) with the added UTM Tags.

### Remove UTM Tags from a contact
```php
<?php
$api->removeUtm($contactId, $utmId);
```

Remove a set of UTM Tags from a contact

#### HTTP Request

To remove UTM Tags from a contact:

`POST /contacts/ID/utm/UTMID/remove`

**Data Parameters**

None required.

#### Response

Same as [Get Contact](#get-contact) without the removed UTM Tags.

### Add Points
```php
<?php

$data = array(
	 'eventName' => 'Score via api',
	 'actionName' => 'Adding',
 );
$api->addPoints($contactId, $pointDelta, $data);
```

Add contact points

#### HTTP Request

To add points to a contact and return a 404 if the lead is not found:

`POST /contacts/ID/points/plus/POINTS`

**Data Parameters (optional)**

Name|Description
----|-----------
eventName|Name of the event
actionName|Name of the action

#### Response

`Expected Response Code: 200`
```json
{
    "success": true
}
```

### Subtract Points
```php
<?php

$data = array(
	 'eventname' => 'Score via api',
	 'actionname' => 'Subtracting',
 );
$api->subtractPoints($contactId, $pointDelta, $data);
```
Subtract contact points

#### HTTP Request

To subtract points from a contact and return a 404 if the contact is not found:

`POST /contacts/ID/points/minus/POINTS`

**Data Parameters (optional)**

Name|Description
----|-----------
eventname|Name of the event
actionname|Name of the action

#### Response

`Expected Response Code: 200`
```json
{
    "success": true
}
```

### List Available Owners

```php
<?php

$owners = $api->getOwners();
```
```json
[
  {
    "id": 1,
    "firstName": "Joe",
    "lastName": "Smith"
  },
  {
    "id": 2,
    "firstName": "Jane",
    "lastName": "Smith"
  }
]
```
Get a list of owners that can be used to assign contacts to when creating/editing.

#### HTTP Request

`GET /contacts/list/owners`

#### Response

`Expected Response Code: 200`

** Owner Properties **

Name|Type|Description
----|----|-----------
id|int|ID of the Reizee user
firstName|string|First name of the Reizee user
lastName|string|Last name of the Reizee user

### List Available Fields
```php
<?php

$fields = $api->getFieldList();
```
```json
{
    "1": {
        "id": 1,
        "label": "Title",
        "alias": "title",
        "type": "lookup",
        "group": "core",
        "order": 1
    },
    "2": {
        "id": 2,
        "label": "First Name",
        "alias": "firstname",
        "type": "text",
        "group": "core",
        "order": 2
    },
    "3": {
        "id": 3,
        "label": "Last Name",
        "alias": "lastname",
        "type": "text",
        "group": "core",
        "order": 3
    },

    "...": {
        "..." : "..."
    }
}
```
Get a list of available contact fields including custom ones.

#### HTTP Request

`GET /contacts/list/fields`

#### Response

`Expected Response Code: 200`

** Field Properties **

Name|Type|Description
----|----|-----------
id|int|ID of the field
label|string|Field label
alias|string|Field alias used as the column name in the database
type|string|Type of field.  I.e. text, lookup, etc
group|string|Group the field belongs to
order|int|Field order

### List Contact Notes
```php
<?php

$notes = $api->getContactNotes($id, $searchFilter, $start, $limit, $orderBy, $orderByDir, $publishedOnly, $minimal);
```
```json
{
    "total": 1,
    "notes": [
        {
              "id": 1,
              "text": "<p>Jim is super cool!</p>",
              "type": "general",
              "dateTime": "2020-07-23T13:14:00-05:00"
        }
    ]
}
```
Get a list of notes for a specific contact.

#### HTTP Request

`GET /contacts/ID/notes`

** Query Parameters **

Name|Description
----|-----------
search|String or search command to filter entities by.
start|Starting row for the entities returned. Defaults to 0.
limit|Limit number of entities to return. Defaults to the system configuration for pagination (30).
orderBy|Column to sort by. Can use any column listed in the response.
orderByDir|Sort direction: asc or desc.

#### Response

`Expected response code: 200`

** Note Properties **

Name|Type|Description
----|----|-----------
id|int|ID of the note
text|string|Body of the note
type|string|Type of note. Options are "general", "email", "call", "meeting"
dateTime|datetime|Date/time string of when the note was created.

### Get Segment Memberships
```php
<?php

$segments = $api->getContactSegments($id);
```
```json
{
    "total": 1,
    "segments": {
        "3": {
            "id": 3,
            "name": "New Contacts",
            "alias": "newcontacts"
        }
    }
}
```
Get a list of contact segments the contact is a member of.

#### HTTP Request

`GET /contacts/ID/segments`

#### Response

`Expected response code: 200`

** List Properties **

Name|Type|Description
----|----|-----------
id|int|ID of the list
name|string|Name of the list
alias|string|Alias of the list used with search commands.
dateAdded|datetime|Date/time string for when the contact was added to the list
manuallyAdded|bool|True if the contact was manually added to the list versus being added by a filter
manuallyRemoved|bool|True if the contact was manually removed from the list even though the list's filter is a match

### Change List Memberships

See [Segements](#segments).


### Get Campaign Memberships
```php
<?php

$campaigns = $api->getContactCampaigns($id);
```
```json
{
    "total": 1,
    "campaigns": {
        "1": {
            "id": 1,
            "name": "Welcome Campaign",
            "dateAdded": "2020-07-21T14:11:47-05:00",
            "manuallyRemoved": false,
            "manuallyAdded": false,
            "list_membership": [
                3
            ]
        }
    }
}
```
Get a list of campaigns the contact is a member of.

#### HTTP Request

`GET /contacts/ID/campaigns`

#### Response

`Expected response code: 200`

** List Properties **

Name|Type|Description
----|----|-----------
id|int|ID of the campaign
name|string|Name of the campaign
dateAdded|datetime|Date/time string for when the contact was added to the campaign
manuallyAdded|bool|True if the contact was manually added to the campaign versus being added by a contact list
manuallyRemoved|bool|True if the contact was manually removed from the campaign when the contact's list is assigned to the campaign
listMembership|array|Array of contact list IDs this contact belongs to that is also associated with this campaign

### Change Campaign Memberships

See [Campaigns](#campaigns).


### Get Contact's Events

```php
<?php

$events = $api->getEvents($id, $search, $includeEvents, $excludeEvents, $orderBy, $orderByDir, $page);
```
Warning: Deprecated. Use `getActivityForContact` instead.

** Query Parameters **

Name|Description
----|-----------
id|Contact ID
filters[search]|String or search command to filter events by.
filters[includeEvents][]|Array of event types to include.
filters[excludeEvents][]|Array of event types to exclude.
order|Array of Column and Direction [COLUMN, DIRECTION].
page|What page number to load

```json
{
  "events":[
    {
      "event":"lead.identified",
      "icon":"fa-user",
      "eventType":"Contact identified",
      "eventPriority":-4,
      "timestamp":"2020-06-09T21:39:08+00:00",
      "featured":true
    }
  ],
  "filters":{
    "search":"",
    "includeEvents":[
      "lead.identified"
    ],
    "excludeEvents":[]
  },
  "order":[
    "",
    "ASC"
  ],
  "types":{
    "lead.ipadded":"Accessed from IP",
    "asset.download":"Asset downloaded",
    "campaign.event":"Campaign action triggered",
    "lead.create":"Contact created",
    "lead.identified":"Contact identified",
    "lead.donotcontact":"Do not contact",
    "email.read":"Email read",
    "email.sent":"Email sent",
    "email.failed":"Failed",
    "form.submitted":"Form submitted",
    "page.hit":"Page hit",
    "point.gained":"Point gained",
    "stage.changed":"Stage changed",
    "lead.utmtagsadded":"UTM tags recorded",
    "page.videohit":"Video View Event"
  },
  "total":1,
  "page":1,
  "limit":25,
  "maxPages":1
}
```
Get a list of contact events the contact created.

#### HTTP Request

`GET /contacts/ID/events`

Warning: Deprecated. Use `GET /contacts/ID/activity` instead.

#### Response

`Expected response code: 200`

** List Properties **

Name|Type|Description
----|----|-----------
events|array|List of events
event|string|ID of the event type
icon|string|Icon class from FontAwesome
eventType|string|Human name of the event
eventPriority|string|Priority of the event
timestamp|timestamp|Date and time when the event was created
featured|bool|Flag whether the event is featured
filters|array|Filters used in the query
order|array|Ordering used in the query
types|array|Array of available event types
total|int|Total number of events in the request
page|int|Current page number
limit|int|Limit of events per page
maxPages|int|How many pages of events are there

### Get activity events for specific contact

```php
<?php

$events = $api->getActivityForContact($id, $search, $includeEvents, $excludeEvents, $orderBy, $orderByDir, $page, $dateFrom, $dateTo);
```
** Query Parameters **

Name|Description
----|-----------
id|Contact ID
filters[search]|String or search command to filter events by.
filters[includeEvents][]|Array of event types to include.
filters[excludeEvents][]|Array of event types to exclude.
filters[dateFrom]|Date from filter. Must be type of `\DateTime` for the PHP API libary and in format `Y-m-d H:i:s` for HTTP param
filters[dateTo]|Date to filter. Must be type of `\DateTime` for the PHP API libary and in format `Y-m-d H:i:s` for HTTP param
order|Array of Column and Direction [COLUMN, DIRECTION].
page|What page number to load
limit|Limit of events per page

```json
{
  "events":[
    {
      "event":"lead.identified",
      "icon":"fa-user",
      "eventType":"Contact identified",
      "eventPriority":-4,
      "timestamp":"2020-06-09T21:39:08+00:00",
      "featured":true
    }
  ],
  "filters":{
    "search":"",
    "includeEvents":[
      "lead.identified"
    ],
    "excludeEvents":[]
  },
  "order":[
    "",
    "ASC"
  ],
  "types":{
    "asset.download": "Asset downloaded",
    "campaign.event": "Campaign action triggered",
    "campaign.event.scheduled": "Campaign event scheduled",
    "lead.donotcontact": "Do not contact",
    "email.failed": "Email failed",
    "email.read": "Email read",
    "email.sent": "Email sent",
    "form.submitted": "Form submitted",
    "lead.imported": "Imported",
    "page.hit": "Page hit",
    "point.gained": "Point gained",
    "stage.changed": "Stage changed",
    "lead.utmtagsadded": "UTM tags recorded",
    "page.videohit": "Video view event"
  },
  "total":1,
  "page":1,
  "limit":25,
  "maxPages":1
}
```
Get a list of contact events the contact had created.

#### HTTP Request

`GET /contacts/ID/activity`

#### Response

`Expected response code: 200`

** List Properties **

Name|Type|Description
----|----|-----------
events|array|List of events
event|string|ID of the event type
icon|string|Icon class from FontAwesome
eventType|string|Human name of the event
eventPriority|string|Priority of the event
timestamp|timestamp|Date and time when the event was created
featured|bool|Flag whether the event is featured
filters|array|Filters used in the query
order|array|Ordering used in the query
types|array|Array of available event types
total|int|Total number of events in the request
page|int|Current page number
limit|int|Limit of events per page
maxPages|int|How many pages of events are there


### Get Activity events for all contacts

```php
<?php

$events = $api->getActivity($search, $includeEvents, $excludeEvents, $orderBy, $orderByDir, $page, $dateFrom, $dateTo);
```
** Query Parameters **

Name|Description
----|-----------
filters[search]|String or search command to filter events by.
filters[includeEvents][]|Array of event types to include.
filters[excludeEvents][]|Array of event types to exclude.
filters[dateFrom]|Date from filter. Must be type of `\DateTime` for the PHP API libary and in format `Y-m-d H:i:s` for HTTP param
filters[dateTo]|Date to filter. Must be type of `\DateTime` for the PHP API libary and in format `Y-m-d H:i:s` for HTTP param
orderBy|Column to sort by. Can use any column listed in the response.
orderByDir|Sort direction: asc or desc.
page|What page number to load

```json
 {
  "events": [
    {
      "event": "meeting.attended",
      "eventId": "meeting.attended65",
      "eventLabel": "Attended meeting - Reizee instance",
      "eventType": "Meeting attendance",
      "timestamp": "2020-08-03T21:03:04+00:00",
      "contactId": "12180",
      "details": {
        "eventName": "reizee-instance",
        "eventId": "371343405",
        "eventDesc": "Reizee instance",
        "joinUrl": ""
      }
    },
    {
      "event": "webinar.attended",
      "eventId": "webinar.attended67",
      "eventLabel": "Attended webinar - Reizee",
      "eventType": "Webinar attendance",
      "timestamp": "2020-08-03T21:03:04+00:00",
      "contactId": "12180",
      "details": {
        "eventName": "reizee",
        "eventId": "530287395",
        "eventDesc": "Reizee",
        "joinUrl": ""
      }
    },
    {
      "event": "webinar.registered",
      "eventId": "webinar.registered66",
      "eventLabel": "Registered for webinar - Reizee",
      "eventType": "Webinar registered for",
      "timestamp": "2020-08-03T21:03:04+00:00",
      "contactId": "12180",
      "details": {
        "eventName": "reizee",
        "eventId": "530287395",
        "eventDesc": "Reizee",
        "joinUrl": "https://global.gotowebinar.com/join/xxx/xxx"
      }
    },
    {
      "event": "campaign.event",
      "eventId": "campaign.event892",
      "eventLabel": {
        "label": "Contact field value \/ Campaign Date",
        "href": "\/s\/campaigns\/view\/498"
      },
      "eventType": "Campaign action triggered",
      "timestamp": "2020-08-03T00:58:25+00:00",
      "contactId": "12281",
      "details": {
        "log": {
          "dateTriggered": "2020-08-03T00:58:25+00:00",
          "metadata": [],
          "type": "lead.field_value",
          "isScheduled": "0",
          "logId": "892",
          "eventId": "1457",
          "campaignId": "498",
          "eventName": "Contact field value",
          "campaignName": "Campaign Date"
        }
      }
    },
    {
      "event": "email.sent",
      "eventId": "email.sent796",
      "eventLabel": {
        "label": "2020-05-23 - Email - Leads - Nurture Flow (Monica) 1",
        "href": "http:\/\/reizee.dev\/email\/view\/597a116ae69ca",
        "isExternal": true
      },
      "eventType": "Email sent",
      "timestamp": "2020-07-27T16:14:34+00:00",
      "contactId": "16419",
      "details": {
        "stat": {
          "id": "796",
          "dateSent": "2020-07-27T16:14:34+00:00",
          "subject": "How to make the case for digital",
          "isRead": "0",
          "isFailed": "0",
          "viewedInBrowser": "0",
          "retryCount": "0",
          "idHash": "597a116ae69ca",
          "openDetails": [],
          "storedSubject": "How to make the case for digital",
          "timeToRead": false,
          "emailId": "78",
          "emailName": "2020-05-23 - Email - Leads - Nurture Flow (Monica) 1"
        },
        "type": "sent"
      }
    },
    {
      "event": "email.read",
      "eventId": "email.read769",
      "eventLabel": {
        "label": "Custom Email: device test",
        "href": "http:\/\/reizee.dev\/email\/view\/5966b0cd571f4",
        "isExternal": true
      },
      "eventType": "Email read",
      "timestamp": "2020-07-12T23:30:56+00:00",
      "contactId": "13930",
      "details": {
        "stat": {
          "id": "769",
          "dateRead": "2020-07-12T23:30:56+00:00",
          "dateSent": "2020-07-12T23:29:17+00:00",
          "isRead": "1",
          "isFailed": "0",
          "viewedInBrowser": "0",
          "retryCount": "0",
          "idHash": "5966b0cd571f4",
          "openDetails": [
            {
              "datetime": "2020-07-12 23:30:56",
              "useragent": "Mozilla\/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/59.0.3071.115 Safari\/537.36",
              "inBrowser": false
            },
            {
              "datetime": "2020-07-13 02:18:51",
              "useragent": "Mozilla\/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/59.0.3071.115 Safari\/537.36",
              "inBrowser": false
            }
          ],
          "storedSubject": "device test",
          "timeToRead": "PT1M39S"
        },
        "type": "read"
      }
    },
    {
      "event": "lead.ipadded",
      "eventId": "lead.ipadded3263",
      "eventLabel": "127.0.0.1",
      "eventType": "Accessed from IP",
      "timestamp": "2020-07-27T03:09:09+00:00",
      "contactId": "3263",
      "details": []
    },
    {
      "event": "form.submitted",
      "eventId": "form.submitted503",
      "eventLabel": {
        "label": "3586 Test",
        "href": "\/s\/forms\/view\/143"
      },
      "eventType": "Form submitted",
      "timestamp": "2020-07-27T03:09:07+00:00",
      "contactId": "16417",
      "details": {
        "submission": {
          "id": 503,
          "ipAddress": {
            "ip": "127.0.0.1"
          },
          "form": {
            "id": 143,
            "name": "3586 Test",
            "alias": "3586_test"
          },
          "dateSubmitted": "2020-07-27T03:09:07+00:00",
          "referer": "http:\/\/reizee.dev\/form\/143",
          "results": {
            "form_id": "143",
            "email": "formtest7@test.com",
            "f_name": ""
          }
        },
        "form": {
          "id": 143,
          "name": "3586 Test",
          "alias": "3586_test"
        },
        "page": {}
      }
    },
    {
      "event": "page.hit",
      "eventLabel": {
        "label": "Test",
        "href": "\/s\/pages\/view\/8"
      },
      "eventType": "Page hit",
      "timestamp": "2020-07-21T20:36:49+00:00",
      "contactId": "16380",
      "details": {
        "hit": {
          "userAgent": "Mozilla\/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/59.0.3071.115 Safari\/537.36",
          "dateHit": "2020-07-21T20:36:49+00:00",
          "url": "http:\/\/reizee.dev\/uncategorized\/translation-test1",
          "query": {
            "pageUrl": "http:\/\/reizee.dev\/uncategorized\/translation-test1"
          },
          "clientInfo": "a:6:{s:4:\"type\";s:7:\"browser\";s:4:\"name\";s:6:\"Chrome\";s:10:\"short_name\";s:2:\"CH\";s:7:\"version\";s:4:\"59.0\";s:6:\"engine\";s:5:\"Blink\";s:14:\"engine_version\";s:0:\"\";}",
          "device": "desktop",
          "deviceOsName": "Mac",
          "deviceBrand": "",
          "deviceModel": "",
          "pageId": "8"
        }
      }
    },
    {
      "event": "point.gained",
      "eventLabel": "2: Page Hit Test \/ 20",
      "eventType": "Point gained",
      "timestamp": "2020-07-20T22:38:28+00:00",
      "contactId": "16379",
      "details": {
        "log": {
          "eventName": "2: Page Hit Test",
          "actionName": "hit",
          "dateAdded": "2020-07-20T22:38:28+00:00",
          "type": "url",
          "delta": "20",
          "id": "2"
        }
      }
    },
    {
      "event": "lead.imported",
      "eventId": "lead.imported6324",
      "eventType": "Imported",
      "eventLabel": {
        "label": "Contact import failed from FakeNameGenerator.com_20d05d9c.csv",
        "href": "\/s\/contacts\/import\/view\/4"
      },
      "timestamp": "2020-07-17T21:42:35+00:00",
      "details": {
        "id": "6324",
        "bundle": "lead",
        "object": "import",
        "action": "failed",
        "properties": {
          "line": 2001,
          "file": "FakeNameGenerator.com_20d05d9c.csv",
          "error": "No data found"
        },
        "userId": "2",
        "userName": "Bob Smith",
        "objectId": "4",
        "dateAdded": "2020-07-17T21:42:35+00:00"
      }
    },
    {
      "event": "asset.download",
      "eventId": "asset.download11",
      "eventLabel": {
        "label": "Download Reizee",
        "href": "\/s\/assets\/view\/1"
      },
      "eventType": "Asset downloaded",
      "timestamp": "2020-04-04T01:49:13+00:00",
      "details": {
        "asset": {
          "id": 1,
          "title": "Download Reizee",
          "alias": "download-reizee",
          "description": "test"
        },
        "assetDownloadUrl": "http:\/\/reizee.dev\/asset\/1:download-reizee"
      }
    },
  ],
  "filters": {
    "search": "",
    "includeEvents": [],
    "excludeEvents": []
  },
  "order": [
    "timestamp",
    "DESC"
  ],
  "types": {
    "lead.ipadded": "Accessed from IP",
    "asset.download": "Asset downloaded",
    "meeting.attended": "Attended meeting",
    "webinar.attended": "Attended webinar",
    "campaign.event": "Campaign action triggered",
    "campaign.event.scheduled": "Campaign event scheduled",
    "lead.donotcontact": "Do not contact",
    "email.failed": "Email failed",
    "email.read": "Email read",
    "email.sent": "Email sent",
    "form.submitted": "Form submitted",
    "lead.imported": "Imported",
    "page.hit": "Page hit",
    "point.gained": "Point gained",
    "meeting.registered": "Registered for meeting",
    "webinar.registered": "Registration to Webinar",
    "stage.changed": "Stage changed",
    "lead.utmtagsadded": "UTM tags recorded",
    "page.videohit": "Video view event"
  },
  "total": 12,
  "page": 1,
  "limit": 25,
  "maxPages": 1
}
```

#### HTTP Request

`GET /contacts/activity`

#### Response

`Expected response code: 200`

** List Properties **

Name|Type|Description
----|----|-----------
events|array|List of events
event|string|ID of the event type
icon|string|Icon class from FontAwesome
eventType|string|Human name of the event
eventPriority|string|Priority of the event
contactId|ID of the contact who created the event
timestamp|timestamp|Date and time when the event was created
featured|bool|Flag whether the event is featured
filters|array|Filters used in the query
order|array|Ordering used in the query
types|array|Array of available event types
total|int|Total number of events in the request
page|int|Current page number
limit|int|Limit of events per page
maxPages|int|How many pages of events are there

### Get Contact's Companies
```php
<?php

$companies = $api->getContactCompanies($contactId);

```json
{
  "total":1,
  "companies":[
    {
      "company_id":"420",
      "date_associated":"2020-12-27 15:03:43",
      "is_primary":"0",
      "companyname":"test",
      "companyemail":"test@company.com",
      "companycity":"Raleigh",
      "score":"0",
      "date_added":"2020-12-27 15:03:42"
    }
  ]
}
```
Get a list of contact's companies the contact belongs to.

#### HTTP Request

`GET /contacts/ID/companies`

#### Response

`Expected response code: 200`

**List Properties**

Name|Type|Description
----|----|-----------
company_id|int|Company ID
date_associated|datetime|Date and time when the contact was associated to the company
date_added|datetime|Date and time when the company was created
is_primary|bool|Flag whether the company association is primary (current)
companyname|string|Name of the company
companyemail|string|Email of the company
companycity|string|City of the company
score|int|Score of the company


### Get Contact's Devices
```php
<?php

$devices = $api->getContactDevices($contactId);

```json
{
  "total":1,
  "devices":[
    {
      "id":60,
      "lead":[],
      "clientInfo":[],
      "device":"desktop",
      "deviceOsName":"Ubuntu",
      "deviceOsShortName":"UBT",
      "deviceOsPlatform":"x64"
    }
  ]
}
```
Get a list of contact's devices the contact has used.

#### HTTP Request

`GET /contacts/ID/devices`

#### Response

`Expected response code: 200`

**List Properties**

Name|Type|Description
----|----|-----------
id|int|Device ID
clientInfo|array|Array with various information about the client (browser)
device|string|Device type; desktop, mobile..
deviceOsName|string|Full device OS name
deviceOsShortName|string|Short device OS name
deviceOsPlatform|string|OS platform


## Companies
Use this endpoint to obtain details on Reizee companies or to manipulate contact-company memberships.

```php
<?php
// Auth
$auth = \ReizeeApi::authenticate();

// Init the api
$api =  \ReizeeApi::newApi('companies', $auth);
```

### Get Company
```php
<?php

//...
$company = $api->get($id);
```
```json
{  
    "company":{  
        "isPublished":true,
        "dateAdded":"2020-10-25T09:46:36+00:00",
        "createdBy":1,
        "createdByUser":"John Doe",
        "dateModified":null,
        "modifiedBy":null,
        "modifiedByUser":null,
        "id":176,
        "fields":{  
            "core":{  
                "companywebsite":{  
                    "id":"91",
                    "label":"Website",
                    "alias":"companywebsite",
                    "type":"url",
                    "group":"core",
                    "field_order":"8",
                    "object":"company",
                    "value":null
                },
                [...]
            },
            "professional":{  
                "companyannual_revenue":{  
                    "id":"90",
                    "label":"Annual Revenue",
                    "alias":"companyannual_revenue",
                    "type":"number",
                    "group":"professional",
                    "field_order":"10",
                    "object":"company",
                    "value":null
                },
                [...]
            },
            "other":[],
            "all":{  
                "companywebsite":null,
                "companycountry":null,
                "companyzipcode":null,
                "companystate":null,
                "companycity":"Raleigh",
                "companyphone":null,
                "companyemail":"test@company.com",
                "companyaddress2":null,
                "companyaddress1":null,
                "companyname":"test",
                "companyannual_revenue":null,
                "companyfax":null,
                "companynumber_of_employees":null,
                "companydescription":null
            }
        }
    }
}
```
Get an individual company by ID.

#### HTTP Request

`GET /companies/ID`

#### Response

`Expected Response Code: 200`

See JSON code example.

**Company Properties**

Name|Type|Description
----|----|-----------
id|int|ID of the company
isPublished|boolean|Whether the company is published
dateAdded|datetime|Date/time company was created
createdBy|int|ID of the user that created the company
createdByUser|string|Name of the user that created the company
dateModified|datetime/null|Date/time company was last modified
modifiedBy|int|ID of the user that last modified the company
modifiedByUser|string|Name of the user that last modified the company
fields|array|Custom fields for the company

### List Contact Companies

```php
<?php

//...
$companies = $api->getList($searchFilter, $start, $limit, $orderBy, $orderByDir, $publishedOnly, $minimal);
```
```json
{
  "total": 13,
  "companies": {
    "176": {  
      "isPublished":true,
      "dateAdded":"2020-10-25T09:46:36+00:00",
      "createdBy":1,
      "createdByUser":"John Doe",
      "dateModified":null,
      "modifiedBy":null,
      "modifiedByUser":null,
      "id":176,
      "fields":{  
        "core":{  
            "companywebsite":{  
                "id":"91",
                "label":"Website",
                "alias":"companywebsite",
                "type":"url",
                "group":"core",
                "field_order":"8",
                "object":"company",
                "value":null
            },
            [...]
        },
        "professional":{  
            "companyannual_revenue":{  
                "id":"90",
                "label":"Annual Revenue",
                "alias":"companyannual_revenue",
                "type":"number",
                "group":"professional",
                "field_order":"10",
                "object":"company",
                "value":null
            },
            [...]
        },
        "other":[],
        "all":{  
            "companywebsite":null,
            "companycountry":null,
            "companyzipcode":null,
            "companystate":null,
            "companycity":"Raleigh",
            "companyphone":null,
            "companyemail":"test@company.com",
            "companyaddress2":null,
            "companyaddress1":null,
            "companyname":"test",
            "companyannual_revenue":null,
            "companyfax":null,
            "companynumber_of_employees":null,
            "companydescription":null
        }
    }
  },
  [...]
  }
}
```
Returns a list of contact companies available to the user. This list is not filterable.

#### HTTP Request

`GET /companies`

** Query Parameters **

Name|Description
----|-----------
search|String or search command to filter entities by.
start|Starting row for the entities returned. Defaults to 0.
limit|Limit number of entities to return. Defaults to the system configuration for pagination (30).
orderBy|Column to sort by. Can use any column listed in the response.
orderByDir|Sort direction: asc or desc.

#### Response

`Expected Response Code: 200`

See JSON code example.

**Company Properties**

Name|Type|Description
----|----|-----------
id|int|ID of the company
isPublished|boolean|Whether the company is published
dateAdded|datetime|Date/time company was created
createdBy|int|ID of the user that created the company
createdByUser|string|Name of the user that created the company
dateModified|datetime/null|Date/time company was last modified
modifiedBy|int|ID of the user that last modified the company
modifiedByUser|string|Name of the user that last modified the company
fields|array|Custom fields for the company

### Create Company
```php
<?php

$data = array(
    'companyname' => 'test',
    'companyemail' => 'test@company.com',
    'companycity' => 'Raleigh',
    'overwriteWithBlank' => true
);

$company = $api->create($data);
```
Create a new company.

#### HTTP Request

`POST /companies/new`

**Post Parameters**

Name|Description
----|-----------
companyname|Company name is the only required field. Other company fields can be sent with a value
isPublished|A value of 0 or 1
overwriteWithBlank|If true, then empty values are set to fields. Otherwise empty values are skipped

#### Response

`Expected Response Code: 201`

**Properties**

Same as [Get Company](#get-company).

### Edit Company
```php
<?php

$id   = 1;
$data = array(
    'companyname' => 'test',
    'companyemail' => 'test@company.com',
    'companycity' => 'Raleigh',
);

// Create new a company of ID 1 is not found?
$createIfNotFound = true;

$company = $api->edit($id, $data, $createIfNotFound);
```
Edit a new company. Note that this supports PUT or PATCH depending on the desired behavior.

**PUT** creates a company if the given ID does not exist and clears all the company information, adds the information from the request.
**PATCH** fails if the company with the given ID does not exist and updates the company field values with the values form the request.

#### HTTP Request

To edit a company and return a 404 if the company is not found:

`PATCH /companies/ID/edit`

To edit a company and create a new one if the company is not found:

`PUT /companies/ID/edit`

**Post Parameters**

Name|Description
----|-----------
companyname|Company name is the only required field. Other company fields can be sent with a value
isPublished|A value of 0 or 1
overwriteWithBlank|If true, then empty values are set to fields. Otherwise empty values are skipped

#### Response

If `PUT`, the expected response code is `200` if the company was edited or `201` if created.

If `PATCH`, the expected response code is `200`.

**Properties**

Same as [Get Company](#get-company).

### Delete Company
```php
<?php

$company = $api->delete($id);
```
Delete a company.

#### HTTP Request

`DELETE /companies/ID/delete`

#### Response

`Expected Response Code: 200`

**Properties**

Same as [Get Company](#get-company).


### Add Contact to a Company

```php
<?php

//...
$response = $api->addContact($companyId, $contactId);
if (!isset($response['success'])) {
    // handle error
}
```
```json
{
    "success": true
}
```

Manually add a contact to a specific company.

#### HTTP Request

`POST /companies/COMPANY_ID/contact/CONTACT_ID/add`

#### Response

`Expected Response Code: 200`

See JSON code example.


### Remove Contact from a Company

```php
<?php

//...
$response = $api->removeContact($contactId, $companyId);
if (empty($response['success'])) {
    // handle error
}
```
```json
{
    "success": true
}
```

Manually remove a contact to a specific company.

#### HTTP Request

`POST /companies/COMPANY_ID/contact/CONTACT_ID/remove`

#### Response

`Expected Response Code: 200`

See JSON code example.

## Campaigns
Use this endpoint to obtain details on Reizee's campaigns.

```php
<?php
// Auth
$auth = \ReizeeApi::authenticate();

// Init the api
$api =  \ReizeeApi::newApi('campaigns', $auth);
```

### Get Campaign
```php
<?php

//...
$campaign = $api->get($id);
```
```json
{
    "campaign": {
        "id": 3,
        "name": "Email A/B Test",
        "description": null,
        "isPublished": true,
        "publishUp": null,
        "publishDown": null,
        "dateAdded": "2020-07-15T15:06:02-05:00",
        "createdBy": 1,
        "createdByUser": "Joe Smith",
        "dateModified": "2020-07-20T13:11:56-05:00",
        "modifiedBy": 1,
        "modifiedByUser": "Joe Smith",
        "category": null,
        "events": {
            "28": {
                "id": 28,
                "type": "lead.changepoints",
                "eventType": "action",
                "name": "Adjust lead points",
                "description": null,
                "order": 1,
                "properties": {
                  "points": 20
                },
                "triggerDate": null,
                "triggerInterval": 1,
                "triggerIntervalUnit": "d",
                "triggerMode": "immediate",
                "children": [],
                "parent": null,
                "decisionPath": null
            }
        }
    }
}
```
Get an individual campaign by ID.

#### HTTP Request

`GET /campaigns/ID`

#### Response

`Expected Response Code: 200`

See JSON code example.

**Campaign Properties**

Name|Type|Description
----|----|-----------
id|int|ID of the campaign
name|string|Name of the campaign
description|string/null|Description of the campaign
alias|string|Used to generate the URL for the campaign
isPublished|bool|Published state
publishUp|datetime/null|Date/time when the campaign should be published
publishDown|datetime/null|Date/time the campaign should be un published
dateAdded|datetime|Date/time campaign was created
createdBy|int|ID of the user that created the campaign
createdByUser|string|Name of the user that created the campaign
dateModified|datetime/null|Date/time campaign was last modified
modifiedBy|int|ID of the user that last modified the campaign
modifiedByUser|string|Name of the user that last modified the campaign
events|array|Array of Event entities for the campaign. See below.

**Event Properties**

Name|Type|Description
----|----|-----------
id|int|ID of the event
name|string|Name of the event
description|string|Optional description for the event
type|string|Type of event
eventType|string|"action" or "decision"
order|int|Order in relation to the other events (used for levels)
properties|object|Configured properties for the event
triggerMode|string|"immediate", "interval" or "date"
triggerDate|datetime/null|Date/time of when the event should trigger if triggerMode is "date"
triggerInterval|int/null|Interval for when the event should trigger
triggerIntervalUnit|string|Interval unit for when the event should trigger. Options are i = minutes, h = hours, d = days, m = months, y = years
children|array|Array of this event's children ,
parent|object/null|This event's parent
decisionPath|string/null|If the event is connected into an action, this will be "no" for the non-decision path or "yes" for the actively followed path.

### List Campaigns
```php
<?php
// ...

$campaigns = $api->getList($searchFilter, $start, $limit, $orderBy, $orderByDir, $publishedOnly, $minimal);
```
```json
{
    "total": 1,
    "campaigns": {
        "3": {
            "id": 3,
            "name": "Welcome Campaign",
            "description": null,
            "isPublished": true,
            "publishUp": null,
            "publishDown": null,
            "dateAdded": "2020-07-15T15:06:02-05:00",
            "createdBy": 1,
            "createdByUser": "Joe Smith",
            "dateModified": "2020-07-20T13:11:56-05:00",
            "modifiedBy": 1,
            "modifiedByUser": "Joe Smith",
            "category": null,
            "events": {
                "22": {
                    "id": 22,
                    "type": "email.send",
                    "eventType": "action",
                    "name": "Send welcome email",
                    "description": null,
                    "order": 1,
                    "properties": {
                        "email": 1
                    },
                    "triggerMode": "immediate",
                    "triggerDate": null,
                    "triggerInterval": null,
                    "triggerIntervalUnit": null,
                    "children": [],
                    "parent": null,
                    "decisionPath": null
                },
                "28": {
                    "id": 28,
                    "type": "lead.changepoints",
                    "eventType": "action",
                    "name": "Adjust lead points",
                    "description": null,
                    "order": 2,
                    "properties": {
                        "points": 20
                    },
                    "triggerMode": "immediate",                
                    "triggerDate": null,
                    "triggerInterval": null,
                    "triggerIntervalUnit": null,
                    "children": [],
                    "parent": null,
                    "decisionPath": null
                }
            }
        }
    }
}
```
#### HTTP Request

`GET /campaigns`

**Query Parameters**

Name|Description
----|-----------
search|String or search command to filter entities by.
start|Starting row for the entities returned. Defaults to 0.
limit|Limit number of entities to return. Defaults to the system configuration for pagination (30).
orderBy|Column to sort by. Can use any column listed in the response.
orderByDir|Sort direction: asc or desc.
published|Only return currently published entities.
minimal|Return only array of entities without additional lists in it.

#### Response

`Expected Response Code: 200`

See JSON code example.

**Properties**

Same as [Get Campaign](#get-campaign).


### List Campaign Contacts

This endpoint is basically an alias for the stats endpoint with 'campaign_leads' table and campaign_id specified. Other parameters are the same as in the stats endpoint.

```php
<?php
// ...

$response = $api->getContacts($campaignId, $start, $limit, $order, $where);
```
```json
{  
  "total":"1",
  "contacts":[  
    {  
      "campaign_id":"311",
      "lead_id":"3126",
      "date_added":"2020-01-25 15:11:10",
      "manually_removed":"0",
      "manually_added":"1"
    }
  ]
}
```
#### HTTP Request

`GET /campaigns/ID/contacts`

**Query Parameters**

#### Response

`Expected Response Code: 200`

See JSON code example.


### Create Campaign
```php
<?php

$data = array(
    'name'        => 'Campaign A',
    'description' => 'This is my first campaign created via API.',
    'isPublished' => 1
);

$campaign = $api->create($data);
```
Create a new campaign. To see more advanced example with campaing events and so on, see the unit tests.

#### HTTP Request

`POST /campaigns/new`

**Post Parameters**

Name|Description
----|-----------
name|Campaign name is the only required field
alias|string|Used to generate the URL for the campaign
description|A description of the campaign.
isPublished|A value of 0 or 1

#### Response

`Expected Response Code: 201`

**Properties**

Same as [Get Campaign](#get-campaign).



### Clone A Campaign
```php
<?php

$camnpaignId = 12;

$campaign = $api->cloneCampaign($campaignId);
```
Clone an existing campaign. To see more advanced example with campaign events and so on, see the unit tests.

#### HTTP Request

`POST /campaigns/clone/CAMPAIGN_ID`

#### Response

`Expected Response Code: 201`

**Properties**

Same as [Get Campaign](#get-campaign).


### Edit Campaign
```php
<?php

$id   = 1;
$data = array(
    'name'        => 'New campaign name',
    'isPublished' => 0
);

// Create new a campaign of ID 1 is not found?
$createIfNotFound = true;

$campaign = $api->edit($id, $data, $createIfNotFound);
```
Edit a new campaign. Note that this supports PUT or PATCH depending on the desired behavior.

**PUT** creates a campaign if the given ID does not exist and clears all the campaign information, adds the information from the request.
**PATCH** fails if the campaign with the given ID does not exist and updates the campaign field values with the values form the request.

#### HTTP Request

To edit a campaign and return a 404 if the campaign is not found:

`PATCH /campaigns/ID/edit`

To edit a campaign and create a new one if the campaign is not found:

`PUT /campaigns/ID/edit`

**Post Parameters**

Name|Description
----|-----------
name|Campaign name is the only required field
alias|Name alias generated automatically if not set
description|A description of the campaign.
isPublished|A value of 0 or 1

#### Response

If `PUT`, the expected response code is `200` if the campaign was edited or `201` if created.

If `PATCH`, the expected response code is `200`.

**Properties**

Same as [Get Campaign](#get-campaign).

### Delete Campaign
```php
<?php

$campaign = $api->delete($id);
```
Delete a campaign.

#### HTTP Request

`DELETE /campaigns/ID/delete`

#### Response

`Expected Response Code: 200`

**Properties**

Same as [Get Campaign](#get-campaign).

### Add Contact to a Campaign

```php
<?php

//...
$response = $api->addContact($campaignId, $contactId);
if (!isset($response['success'])) {
    // handle error
}
```
```json
{
    "success": true
}
```

Manually add a contact to a specific campaign.

#### HTTP Request

`POST /campaigns/CAMPAIGN_ID/contact/CONTACT_ID/add`

#### Response

`Expected Response Code: 200`

See JSON code example.


### Remove Contact from a Campaign

```php
<?php

//...
$response = $listApi->removeContact($campaignId, $contactId);
if (!isset($response['success'])) {
    // handle error
}
```
```json
{
    "success": true
}
```

Manually remove a contact from a specific campaign.

#### HTTP Request

`POST /campaigns/CAMPAIGN_ID/contact/CONTACT_ID/remove`

#### Response

`Expected Response Code: 200`

See JSON code example.




