<?php

namespace MasterClass\Configuration;

use Aura\Di\Config;
use Aura\Di\Container;
use MasterClass\Route\GetRoute;
use MasterClass\Route\PostRoute;

class RouterConfig extends Config
{
    public function define(Container $di)
    {
        $config = $di->get('config');
        $routes = $config['routes'];

        $routeObj = [];

        foreach($routes as $path => $route) {
            if ($route['type'] == 'POST') {
                $routeObj[] = new PostRoute($path, $route['class']);
            } else {
                $routeObj[] = new GetRoute($path, $route['class']);
            }
        }

        $di->params['MasterClass\Router'] = [
            'serverVars' => $_SERVER,
            'routes' => $routeObj,
        ];
    }
}
