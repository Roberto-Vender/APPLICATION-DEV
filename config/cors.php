<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://application-dev-rj8t.onrender.com', // deployed React
        'http://localhost:5173', // local dev React
        'http://localhost:3000', // alternative local dev
        'https://application-dev-1-1.onrender.com', // your deployed frontend
        'https://application-dev-1-oat5.onrender.com', // optional previous frontend
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
