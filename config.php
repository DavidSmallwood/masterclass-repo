<?php

return array(

    'database' => array(
        'user' => 'root',
        'pass' => 'montezumA01',
        'host' => 'localhost',
        'name' => 'oop_class',
    ),
    
    'routes' => array(
        '' => 'index/index',
        'story' => 'story/index',
        'story/create' => 'story/create',
        'comment/create' => 'comment/create',
        'user/create' => 'user/create',
        'user/account' => 'user/account',
        'user/login' => 'user/login',
        'user/logout' => 'user/logout',
    ),
);