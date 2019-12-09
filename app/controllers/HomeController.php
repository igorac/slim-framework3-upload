<?php

namespace App\controllers;

use App\models\Model;
use App\models\Post;
use App\models\User;

class HomeController extends Controller
{

    public function index()
    {
        // $user = new User;
        // $users = $user->select()->busca('name,email')->paginate(5)->get();

        $post = new Post;
        $posts = $post->posts()->busca('title,description')->paginate(4)->get();

        $this->view('home', [
            // 'users' => $users,
            'title' => 'Home',
            'posts' => $posts,
            'links' => $post->links(),
        ]);
    }

}