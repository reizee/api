# Usando a biblioteca de API para o Reizee

## Requirements

- PHP 7.2 or newer
- cURL support
- Laravel 6+

## Instalando

Instale usando o seguinte comando:

```bash
composer require reizee/api
```

Publique as configurações

```bash
php artisan vendor:publish --provider="Reizee\Api\ReizeeApiServiceProvider" --tag="config"
```

## Autenticação

### Autenticação Básica

A autenticação básica usa um usuário e senha comun da plataforma. Recomendamos que crie um específico para este fim.

## Configurações

Você precisa ativar o recurso de API nas configurações do seu painel.

Abra o arquivo `config/reizee.php` e configure conforme exemplo:

```php
<?php

return [
    'api' => [
        'version' => 'BasicAuth',
        'BasicAuth' => [
            'baseUrl'          => 'https://{SEUDOMINIO}.reizee.com.br',
            'userName'         => 'integracao@reizee.com.br',
            'password'         => 'SENHAAQUI',
        ],
    ]
];

```

# Como usar

## Criar um contato

```php
<?php

// Faça a autenticação
$auth = \ReizeeApi::authenticate();


$api =  \ReizeeApi::newApi(\ReizeeApi::CONTEXT_CONTACT, $auth);

// Initiate process for obtaining an access token; this will redirect the user to the $authorizationUrl and/or
// set the access_tokens when the user is redirected back after granting authorization

// If the access token is expired, and a refresh token is set above, then a new access token will be requested

try {
    if ($auth->validateAccessToken()) {

        // Obtain the access token returned; call accessTokenUpdated() to catch if the token was updated via a
        // refresh token

        // $accessTokenData will have the following keys:
        // For OAuth1.0a: access_token, access_token_secret, expires
        // For OAuth2: access_token, expires, token_type, refresh_token

        if ($auth->accessTokenUpdated()) {
            $accessTokenData = $auth->getAccessTokenData();

            //store access token data however you want
        }
    }
} catch (Exception $e) {
    // Do Error handling
}
```

### Using Basic Authentication Instead

Instead of messing around with OAuth, you may simply elect to use BasicAuth instead.

Here is the BasicAuth version of the code above.

```php
<?php

// Bootup the Composer autoloader
include __DIR__ . '/vendor/autoload.php';

use Reizee\Auth\ApiAuth;

session_start();

// ApiAuth->newAuth() will accept an array of Auth settings
$settings = [
    'userName'   => '',             // Create a new user
    'password'   => '',             // Make it a secure password
];

// Initiate the auth object specifying to use BasicAuth
$initAuth = new ApiAuth();
$auth     = $initAuth->newAuth($settings, 'BasicAuth');

// Nothing else to do ... It's ready to use.
// Just pass the auth object to the API context you are creating.
```

**Note:** If the credentials are incorrect an error response will be returned.

```php
 [
    'errors' => [
        [
            'code'    => 403,
            'message' => 'access_denied: OAuth2 authentication required',
            'type'    => 'access_denied',
        ],
    ],
 ];

```

**Note:** You can also specify a CURLOPT_TIMEOUT in the request (default is set to wait indefinitely):

```php
$initAuth = new ApiAuth();
$auth     = $initAuth->newAuth($settings, 'BasicAuth');
$timeout  = 10;

$auth->setCurlTimeout($timeout);
```

## API Requests

Now that you have an access token and the auth object, you can make API requests. The API is broken down into contexts.

### Get a context object

```php
<?php

use Reizee\ReizeeApi;

// Create an api context by passing in the desired context (Contacts, Forms, Pages, etc), the $auth object from above
// and the base URL to the Reizee server (i.e. http://my-reizee-server.com/api/)

$api        = new ReizeeApi();
$contactApi = $api->newApi('contacts', $auth, $apiUrl);
```

Supported contexts are currently:

See the [developer documentation](https://developer.reizee.org).

### Retrieving items

All of the above contexts support the following functions for retrieving items:

```php
<?php

$response = $contactApi->get($id);
$contact  = $response[$contactApi->itemName()];

// getList accepts optional parameters for filtering, limiting, and ordering
$response      = $contactApi->getList($filter, $start, $limit, $orderBy, $orderByDir);
$totalContacts = $response['total'];
$contact       = $response[$contactApi->listName()];
```

### Creating an item

```php
<?php

$fields = $contactApi->getFieldList();

$data = array();

foreach ($fields as $field) {
    $data[$field['alias']] = $_POST[$field['alias']];
}

// Set the IP address the contact originated from if it is different than that of the server making the request
$data['ipAddress'] = $ipAddress;

// Create the contact
$response = $contactApi->create($data);
$contact  = $response[$contactApi->itemName()];
```

### Editing an item

```php
<?php

$updatedData = [
    'firstname' => 'Updated Name'
];

$response = $contactApi->edit($contactId, $updatedData);
$contact  = $response[$contactApi->itemName()];

// If you want to create a new contact in the case that $contactId no longer exists
// $response will be populated with the new contact item
$response = $contactApi->edit($contactId, $updatedData, true);
$contact  = $response[$contactApi->itemName()];
```

### Deleting an item

```php
<?php

$response = $contactApi->delete($contactId);
$contact  = $response[$contactApi->itemName()];
```

### Error handling

```php
<?php

// $response returned by an API call should be checked for errors
$response = $contactApi->delete($contactId);

if (isset($response['errors'])) {
    foreach ($response['errors'] as $error) {
        echo $error['code'] . ": " . $error['message'];
    }
}




```
