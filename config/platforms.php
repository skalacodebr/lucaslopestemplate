<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Plataformas Externas
    |--------------------------------------------------------------------------
    |
    | URLs das plataformas externas utilizadas no menu flutuante
    | e em outras partes do site.
    |
    */

    'ead_url' => env('EAD_PLATFORM_URL', 'https://ead.globalsst.com.br'),

    'platform_url' => env('NEW_PLATFORM_URL', 'https://plataforma.globalsst.com.br'),

    'whatsapp' => [
        'number' => env('WHATSAPP_NUMBER', '5511999999999'),
        'url' => env('WHATSAPP_URL', 'https://wa.me/5511999999999'),
    ],

    'contact' => [
        'phone' => env('CONTACT_PHONE', '(11) 99999-9999'),
        'email' => env('CONTACT_EMAIL', 'contato@globalsst.com.br'),
        'address' => env('CONTACT_ADDRESS', 'Rua das Empresas, 123 - Sala 456, Centro - São Paulo/SP, CEP: 01234-567'),
    ],
];