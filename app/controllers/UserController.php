<?php

namespace App\controllers;

use App\models\User;
use App\src\Validate;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function edit(Request $request, Response $response, array $args)
    {
        $userFound = $this->user->select()->where('id', $args['id'])->first();

        $this->view('user', [
            'title' => 'Editar usuário',
            'user'  => $userFound
        ]);
    }

    public function update(Request $request, Response $response, array $args)
    {

        $validate = new Validate;

        $data = $validate->validate([
            'name' => 'required:min@3',
            'email' => 'required',
            'phone' => 'required:phone'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $updated = $this->user->find('id', $args['id'])->update([
            'name'  => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
        ]);

        if ($updated) {
            flash('message', success('Atualizado com sucesso!'));
            return back();
        }

        flash('message', error('Erro ao atualizar!'));
        return back();
    }

    public function delete(Request $request, Response $response, array $args)
    {
    
        $deleted = $this->user->find('id', $args['id'])->delete();

        if ($deleted) {
            flash('message', success('Deletado com sucesso!'));
            redirect('/');
        }

        flash('message', error('Erro ao deletar'));
        redirect('/');
    }

}