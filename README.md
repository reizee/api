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

Você precisa ativar o recurso de API nas configurações do seu painel e habilitar autenticação básica.

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

```php
<?php

// Faça a autenticação
$auth = \ReizeeApi::authenticate();

// Inicialize a API
$api =  \ReizeeApi::newApi('contacts', $auth);

// Cria o contato e retorna o resultado
$result = $api->create([
            'email' => 'contato@reizee.com.br',
            'firstname' => 'Reizee',
            'tags' => ['tag-1', 'tag-2'],
            'custom_field_x' => 'custom'
        ]);


// Editar o contato e retorna o resultado
$id = 1;
$result = $api->edit($id ,[
            'lastname' => 'Marketing',
             // Adicione uma nova tag ou remova adicionando sinal de
             // menos (-) antes do nome da tag
            'tags' => ['tag-3', '-tag-2'],
            'custom_field_x' => 'custom_alterado'
        ]);


// Deletar um contato
$id = 1;
$result = $api->delete($id);

// Para empresas o processo é o mesmo, só muda o contexto

// Inicialize a API
$api =  \ReizeeApi::newApi('companies', $auth);

$result = $api->create([
            'companyemail' => 'contato@reizee.com.br',
            'companyname' => 'Reizee',
            'tags' => ['tag-1', 'tag-2'],
            'company_custom_field_x' => 'custom'
        ]);
// ...

// Outros contextos podem ser usados, em breve atualizaremos nossa documentação
```


