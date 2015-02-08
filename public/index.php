<?php

session_start();

$config = require_once('../config.php');
require '../vendor/autoload.php';

$framework = new \MasterClass\MasterController($config);
echo $framework->execute();