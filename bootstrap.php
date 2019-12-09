<?php

session_start();
ini_set('xdebug.overload_var_dump', 1);

require "vendor/autoload.php";

use App\src\Whoops;
use Slim\App;

$config['displayErrorDetails'] = true;

$app = new App(['settings' => $config]);

$whoops = new Whoops;
$whoops->run($app);
