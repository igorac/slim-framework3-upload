<?php

namespace App\traits;

use App\src\Load;


/**
 * Abstraindo o componente Twig
 */

trait View
{

    protected $twig;

   

    /**
     * Carrega o twig com as configurações do twig 
     * e com o path dos templates a serem renderizados
     */
    protected function twig()
    {
        // Diz para o twig, o local dos templates que serão renderizados
        $loader = new \Twig\Loader\FilesystemLoader('../app/views');


        // Configurações do Twig
        $this->twig = new \Twig\Environment($loader, [
            // 'cache' => '',
            'debug' => true
        ]);
    }

    /**
     * Carrega as functions do twig custom 
     */
    protected function functions()
    {

        $functions = Load::file('/app/functions/twig.php');

        foreach($functions as $function) {
            $this->twig->addFunction($function);
        }
    }


    /**
     * Chama functions() e o twig()
     */
    protected function loadTwigAndFunctions()
    {
        $this->twig();
        $this->functions();
    }


    /**
     * Responsável por renderizar a view com os dados
     */
    protected function view($view, array $data)
    {
        $this->loadTwigAndFunctions(); // Carrega as functions() e o view()
        $template = $this->twig->load(str_replace('.', '/', $view).'.html'); // Renderiza o template

        return $template->display($data); // Exibe a view com os dados
    }

}