<?php

return array(

    'database' => array(
        'user' => 'root',
        'pass' => 'montezumA01',
        'host' => 'localhost',
        'name' => 'oop_class',
    ),
    
    'routes' => array(
        '' => 'MasterClass\Controllers\Index:index',
        'story' => 'MasterClass\Controllers\Story:index',
        'story/create' => 'MasterClass\Controllers\Story:create',
        'comment/create' => 'MasterClass\Controllers\Comment:create',
        'user/create' => 'MasterClass\Controllers\User:create',
        'user/account' => 'MasterClass\Controllers\User:account',
        'user/login' => 'MasterClass\Controllers\User:login',
        'user/logout' => 'MasterClass\Controllers\User:logout',
    ),
);
