<?php

session_start();

$config = require_once('../config.php');
require '../vendor/autoload.php';

$framework = new MasterController($config);
echo $framework->execute();