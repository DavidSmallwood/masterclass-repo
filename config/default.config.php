<?php

$path = realpath(__DIR__ . '/..');

return array(

    'path' => $path,
    
    'database' => array(
        'user' => '',
        'pass' => '',
        'host' => '',
        'name' => '',
    ),
    
    'routes' => array(
        '/' => ['class' => 'MasterClass\Controllers\Index:index', 'type' => 'GET'],
        '/story' => ['class' => 'MasterClass\Controllers\Story:index', 'type' => 'GET'],
        '/story/create' => ['class' => 'MasterClass\Controllers\Story:create', 'type' => 'GET'],
        '/story/create/save' => ['class' => 'MasterClass\Controllers\Story:create', 'type' => 'POST'],
        '/comment/create' => ['class' => 'MasterClass\Controllers\Comment:create', 'type' => 'POST'],
        '/user/create' => ['class' => 'MasterClass\Controllers\User:create', 'type' => 'GET'],
        '/user/account/create' => ['class' => 'MasterClass\Controllers\User:create', 'type' => 'POST'],
        '/user/account' => ['class' => 'MasterClass\Controllers\User:account', 'type' => 'GET'],
        '/user/account/save' => ['class' => 'MasterClass\Controllers\User:account', 'type' => 'POST'],
        '/user/login/check' => ['class' => 'MasterClass\Controllers\User:login', 'type' => 'POST'],
        '/user/login' => ['class' => 'MasterClass\Controllers\User:login', 'type' => 'GET'],
        '/user/logout' => ['class' => 'MasterClass\Controllers\User:logout', 'type' => 'GET'],
    ),

    'config_classes' => [
        'MasterClass\Configuration\DiConfig',
        'MasterClass\Configuration\RouterConfig',
        'MasterClass\Configuration\Web',
        'MasterClass\Configuration\View',
    ],

    'layouts' => [
        'layout' => $path . '/views/layout.php',
    ],

    'views' => [

        'index' => $path . '/views/index.php',
        'story' => $path . '/views/story.php',
        'story_create' => $path . '/views/story_create.php',
        //'error' => $path . '/views/error.php',
    ]
);
