<?php

use App\Core\Env;

return [
    'name' => Env::get('APP_NAME', 'Bright Mind Computer Solutions'),
    'url' => Env::get('APP_URL', 'http://localhost:8000'),
    'env' => Env::get('APP_ENV', 'production'),
    'debug' => Env::get('APP_DEBUG', 'false') === 'true',

    'contact' => [
        'phone' => Env::get('SITE_PHONE', '+971 4 227 1773'),
        'email' => Env::get('SITE_EMAIL', 'info@bmcs.ae'),
        'whatsapp' => Env::get('WHATSAPP_NUMBER', ''),
    ],
];
