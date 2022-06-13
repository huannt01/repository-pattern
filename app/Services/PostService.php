<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Dotenv\Parser\Value;
use Illuminate\Support\Facades\Validator;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function savePostData($data)
    {
        // $validate = $data->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        // ]);

        $validator = Validator::make($data, [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Invalid input value'
            ]);
        }

        $result = $this->postRepository->save($data);
        return $result;
    }

    public function getAllPost()
    {
        return $this->postRepository->getAllPost();
    }

    public function getPostById($post)
    {
        return $this->postRepository->getPostById($post);
    }

    public function update($data, $post)
    {
        $validator = Validator::make($data, [
            'title' => 'required|min:3',
            'description' => 'required|min:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Invalid input value'
            ]);
        }

        return $this->postRepository->update($data, $post);
    }

    public function deletePost($post)
    {
        $post = $this->postRepository->deletePost($post);
        return $post;
    }
}
