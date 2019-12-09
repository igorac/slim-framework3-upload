<?php

namespace App\controllers;

class PerfilController extends Controller
{
    public function index()
    {
        $this->view('perfil', [
            'title' => 'Upload de imagens com resize',
        ]);
    }

    public function store()
    {

        $imagem = new Image;

        $imagem->size('post|user')->upload();
    }
    
}