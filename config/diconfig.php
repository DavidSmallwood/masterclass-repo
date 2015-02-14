<?php
$di = new Aura\Di\Container(new Aura\Di\Factory());

$db = $config['database'];

$dsn = 'mysql:host=' . $db['host'] . ';dbname=' . $db['name'];

$di->params['PDO'] = [
    'dsn' => $dsn,
    'username' => $db['user'],
    'passwd' => $db['pass'],
];

$di->params['MasterClass\Model\Comment'] = [
    'pdo' => $di->lazyNew('PDO')
];

$di->params['MasterClass\Model\Story'] = [
    'pdo' => $di->lazyNew('PDO'),
];

$di->params['MasterClass\FrontController'] = [
    'container' => $di,
    'config' => $config,
    'router' => $di->lazyNew('MasterClass\Router'),
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
    'commentModel' => $di->lazyNew('MasterClass\Model\Comment'),
];

$di->params['MasterClass\Controllers\User'] = [
    'config' => $config,
];