<?php
namespace App\src;

use Dopesong\Slim\Error\Whoops as WhoopsError;
use Whoops\Handler\PrettyPageHandler;

class Whoops extends WhoopsError
{
    private function slim(\Slim\App $app)
    {
        $container = $app->getContainer();

        $container['phpErrorHandler'] = $container['errorHandler'] = function() {
            // return new WhoopsError();
            return $this; // Pois já está estendendo o WhoopsError
        };
    }

    private function php()
    {
        $this->pushHandler(new PrettyPageHandler);

        $this->register();
    }

    public function run(\Slim\App $app)
    {
        $this->php();
        $this->slim($app);
    }
}