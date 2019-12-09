<?php

namespace App\controllers;

use App\models\Post;

class PostsController extends Controller
{
    protected $post;
    
    public function __construct()
    {
        $this->post = new Post;
    }

    public function index()
    {
        $posts = $this->post->all();

        $this->view('posts', [
            'title' => 'Lists of the posts',
            'posts' => $posts
        ]);
    }
}