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

$di->params['MasterClass\Mediator\Master'] = [
    'container' => $di,
    'config' => $config,
];

$di->params['MasterClass\Controllers\Comment'] = [
    'commentModel' => $di->lazyNew('Masterclass\Model\Comment'),
];

$di->params['MasterClass\Controllers\Story'] = [
    'storyModel' => $di->lazyNew('Masterclass\Model\Story'),
    'commentModel' => $di->lazyNew('Masterclass\Model\Comment'),
];

$di->params['MasterClass\Controllers\Index'] = [
    'storyModel' => $di->lazyNew('Masterclass\Model\Story'),
    'commentModel' => $di->lazyNew('Masterclass\Model\Comment'),
];

$di->params['MasterClass\Controllers\User'] = [
    'config' => $config,
];