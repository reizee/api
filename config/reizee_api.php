<?php

use Laravel\Fortify\Features;

return [
    'baseUrl'           =>  'http://reizee.localhost',
    'userName'          =>  'username@reizee.com.br',
    'password'          =>  'secret',
    'field_map'         => [
        'email' => 'email',
        'firstname' => 'name'
    ],
];
