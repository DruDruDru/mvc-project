<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Класс прав доступа
    'right' => \Src\Right\Right::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'right' => \Middlewares\RightMiddleware::class,
    ],
    'routeAppMiddleware' => [
        'trim' => \Middlewares\TrimMiddleware::class,
    ],
    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class
    ]
];
