<?php
require dirname(__DIR__) . "/bootstrap.php";


$app->get('/', 'App\controllers\HomeController:index');
$app->get('/cadastro', 'App\controllers\CadastroController:create');
$app->post('/cadastro/store', 'App\controllers\CadastroController:store');
$app->get('/user/edit/{id}', 'App\controllers\UserController:edit');
$app->put('/user/update/{id}', 'App\controllers\UserController:update');
$app->delete('/user/delete/{id}', 'App\controllers\UserController:delete');
$app->get('/contato', 'App\controllers\ContatoController:index');
$app->post('/contato/store', 'App\controllers\ContatoController:store');
$app->get('/perfil', 'App\controllers\PerfilController:index');
$app->post('/user/photo/update', 'App\controllers\PerfilController:store');

$app->run();