<?php

namespace App\models;

class Post extends Model
{
    protected $table = 'posts';

    public function posts(): self
    {
        $this->sql = "select posts.id, posts.title, posts.description, users.name from {$this->table} INNER JOIN users ON (users.id = posts.user_id)";

        return $this;
    }
}