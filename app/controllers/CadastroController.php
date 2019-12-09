<?php

namespace App\controllers;

use App\models\User;
use App\src\Redirect;
use App\src\Validate;

class CadastroController extends Controller 
{
    public function create()
    {
        $this->view('/cadastro', [
            'title' => 'Cadastro'
        ]);
    }

    public function store()
    {
        $validate = new Validate;

        $data = $validate->validate([
            'name' => 'required:min@3',
            'email' => 'required:email:unique@user',
            'phone' => 'required:phone'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $user = new User;
        $user = $user->create((array) $data);

        if ($user) {
            flash('message', success('Cadastrado com sucesso!'));
            back();
        }
    }
    
}
