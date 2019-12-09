<?php

namespace App\controllers;

use App\src\Email;
use App\src\Validate;
use App\templates\Contato;

class ContatoController extends Controller
{
    
    public function index()
    {
        $this->view('contato', [
            'title' => 'Contato',
            'nome'  => 'Igor'
        ]);
    }

    public function store()
    {
        $validate = new Validate;
        $data = $validate->validate([
            'name' => 'required',
            'email' => 'required:email',
            'assunto' => 'required',
            'mensagem' => 'required'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $email = new Email;

        $email->data([
            'fromName' => $data->name,
            'fromEmail' => $data->email,
            'toName' => 'Igor A.C',
            'toEmail' => 'igorac1999@gmail.com',
            'mensagem' => $data->mensagem,
            'assunto' => $data->assunto
        ])->template(new Contato)->send();
    }
}