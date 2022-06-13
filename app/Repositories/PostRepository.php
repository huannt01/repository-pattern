<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function save($data)
    {
        $post = new $this->post;
        $post['title'] = $data['title'];
        $post['description'] = $data['description'];
        $post->save();

        return $post->fresh();
    }

    public function getAllPost()
    {
        $posts = $this->post->get();
        return $posts;
    }

    public function getPostById($post)
    {
        return $post;
    }

    public function update($data, $post)
    {
        $post = $this->post->find($post->id);

        $post->title = $data['title'];
        $post->description = $data['description'];

        $post->update();
        return $post;
    }

    public function deletePost($post)
    {
        $post = $this->post->find($post->id);
        $post->delete();
        return $post;
    }
}
