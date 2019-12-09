<?php

namespace App\controllers;

use App\models\User;
use App\src\Image;
use App\src\Validate;

class PerfilController extends Controller
{
    public function index()
    {
        $user = new User;
        $user = $user->select()->where('id', 1)->first();

        $this->view('perfil', [
            'title' => 'Upload de imagens com resize',
            'user' => $user,
        ]);
    }

    public function store()
    {

        $validate = new Validate;
        $validate->validate([
            'files' => 'image'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }
        

        $user = new User;
        $userFound = $user->select()->where('id', 1)->first();

        $imagem = new Image('files');
        $imagem->delete($userFound->photo);
        $imagem->size('user')->upload();

        // $user = new User;
        $user->find('id', 1)->update([
            'photo' => "/assets/images/photos/{$imagem->getName()}",
        ]);

        flash('message', success('Upload feito com sucesso'));

        back();

    }
    
}