<?php

session_start();
$path = realpath(__DIR__ . '/..');
include $path . '/vendor/krumo/class.krumo.php';

require $path . '/vendor/autoload.php';

$config = function() use ($path) {
  return require ($path . '/config/config.php');
};

$configuration = require ($path . '/config/config.php');

$diContainerBuilder = new Aura\Di\ContainerBuilder();
$di = $diContainerBuilder->newInstance(['config' => $config],
                                       $configuration['config_classes']);
 
 
$framework = $di->newInstance('MasterClass\FrontController');
echo $framework->execute();

