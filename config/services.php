<?php

return [
    'authors'   =>  [
        'base_uri'  =>  env('AUTHORS_SERVICE_BASE_URL'),
        'secret'  =>  env('AUTHORS_SERVICE_SECRET'),
    ],

    'books'   =>  [
        'base_uri'  =>  env('BOOKS_SERVICE_BASE_URL'),
        'secret'  =>  env('BOOKS_SERVICE_SECRET'),
    ],

    'posts'   =>  [
        'base_uri'  =>  env('POSTS_SERVICE_BASE_URL'),
        'secret'  =>  env('POSTS_SERVICE_SECRET'),
    ],

    'products'   =>  [
        'base_uri'  =>  env('PRODUCTS_SERVICE_BASE_URL'),
        'secret'  =>  env('PRODUCTS_SERVICE_SECRET'),
    ],
    'passport'   =>  [
        'auth_endpoint'  =>  env('AUTH_ENDPOINT'),

    ],
];