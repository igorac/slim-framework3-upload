<?php

/**
 * Functions Custons Twig
 */

use App\src\Flash;

$message = new \Twig\TwigFunction('message', function($index){
    echo Flash::get($index);
});

$assets = new \Twig\TwigFunction('assets', function($target) {
    echo assets($target);
});



// Responsável por retornar as functions
return [ 
  $message,
  $assets,
];