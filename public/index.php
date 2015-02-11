<?php

session_start();

$config = require_once('../config.php');
require '../vendor/autoload.php';
include '../vendor/krumo/class.krumo.php';

$framework = new \MasterClass\Mediator\Master($config);
echo $framework->execute();