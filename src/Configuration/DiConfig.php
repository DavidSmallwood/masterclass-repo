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

        $di->params['MasterClass\FrontController'] = [
            'container' => $di,
            'config' => $config,
            'router' => $di->lazyNew('MasterClass\Router'),
        ];

        $di->params['MasterClass\Controllers\Comment'] = [
            'commentModel' => $di->lazyNew('MasterClass\Model\Comment'),
            'request' => $di->lazyNew('Aura\Web\Request'),
            'response' => $di->lazyNew('Aura\Web\Response'),
        ];

        $di->params['MasterClass\Controllers\Story'] = [
            'storyModel' => $di->lazyNew('MasterClass\Model\Story'),
            'request' => $di->lazyNew('Aura\Web\Request'),
            'response' => $di->lazyNew('Aura\Web\Response'),
            'view' => $di->lazyNew('Aura\View\View'),
        ];

        $di->params['MasterClass\Controllers\Index'] = [
            'storyModel' => $di->lazyNew('MasterClass\Model\Story'),
            'request' => $di->lazyNew('Aura\Web\Request'),
            'response' => $di->lazyNew('Aura\Web\Response'),
            'view' => $di->lazyNew('Aura\View\View'),
        ];

        $di->params['MasterClass\Controllers\User'] = [
            'config' => $config,
        ];
    }
}
