<?php

return [
    'api' => [
        'version' => 'BasicAuth',
        'OAuth2' => [
            'baseUrl'          => '',       // Base URL of the Reizee instance
            'version'          => 'OAuth2', // Version of the OAuth can be OAuth2 or OAuth1a. OAuth2 is the default value.
            'clientKey'        => '',       // Client/Consumer key from Reizee
            'clientSecret'     => '',       // Client/Consumer secret key from Reizee
            'callback'         => '',       // Redirect URI/Callback URI for this script
        ],
        'BasicAuth' => [
            'baseUrl'          => '',       // Base URL of the Reizee instance
            'userName'         => '',       // Create a new user       
            'password'         => '',       // Make it a secure password
        ],
        'fieldMap'         => [
            // Map Order
            // Reizee Fields -> Your Application Fields
            'email' => 'email',
            'firstname' => 'name'
        ],
    ]
];
