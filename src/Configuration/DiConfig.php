<?php

namespace MasterClass\Configuration;

use Aura\Di\Config;
use Aura\Di\Container;

class DiConfig extends Config
{
    public function define(Container $di)
    {
        $config = $di->get('config');

        $db = $config['database'];

        $dsn = 'mysql:host=' . $db['host'] . ';dbname=' . $db['name'];

        $di->params['MasterClass\Dbal\AbstractDb'] = [
            'dsn' => $dsn,
            'user' => $db['user'],
            'pass' => $db['pass'],
        ];

        $di->params['MasterClass\Model\Comment'] = [
            'db' => $di->lazyNew('MasterClass\Dbal\Mysql')
        ];

        $di->params['MasterClass\Model\Story'] = [
            'db' => $di->lazyNew('MasterClass\Dbal\Mysql'),
        ];

        $di->params['MasterClass\Mediator\Master'] = [
            'container' => $di,
            'config' => $config,
            'router' => $di->lazyNew('MasterClass\Router\Router'),
        ];

        $di->params['MasterClass\Controllers\Comment'] = [
            'commentModel' => $di->lazyNew('MasterClass\Model\Comment'),
        ];

        $di->params['MasterClass\Controllers\Story'] = [
            'storyModel' => $di->lazyNew('MasterClass\Model\Story'),
            'commentModel' => $di->lazyNew('MasterClass\Model\Comment'),
        ];

        $di->params['MasterClass\Controllers\Index'] = [
            'storyModel' => $di->lazyNew('MasterClass\Model\Story'),
        ];

        $di->params['MasterClass\Controllers\User'] = [
            'config' => $config,
        ];
    }
}
