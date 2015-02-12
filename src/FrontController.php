<?php

namespace MasterClass;

use Aura\Di\Container as AuraContainer;
use MasterClass\Router;

class FrontController {
    
    protected $config;
    
    protected $container;
    
    protected $router;
    
    public function __construct(AuraContainer $container, array $config = [], Router $router) {
        $this->config = $config;
        $this->container = $container;
        $this->router = $router;
        
    }
    
    public function execute() {
    
        $match = $this->_determineControllers();
        $calling = $match->getRouteClass();
        list($class, $method) = explode(':', $calling);
        $o = $this->container->newInstance($class);
        return $o->$method();
    }
    
    protected function _determineControllers()
    {
        $router =$this->router;
        $match = $router->findMatch();
        
        if (!$match) {
            throw new \Exception('No route match found!');
        }
        return $match;
    }    
}