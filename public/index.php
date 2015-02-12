<?php

session_start();
include '../vendor/krumo/class.krumo.php';
$config = require_once('../config/config.php');
require '../vendor/autoload.php';
require_once '../config/diconfig.php';

$framework = $di->newInstance('MasterClass\Mediator\Master');
echo $framework->execute();
