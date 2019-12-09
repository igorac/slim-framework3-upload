<?php

session_start();

require "vendor/autoload.php";

use App\src\Whoops;
use Slim\App;

$config['displayErrorDetails'] = true;

$app = new App(['settings' => $config]);

$whoops = new Whoops;
$whoops->run($app);
