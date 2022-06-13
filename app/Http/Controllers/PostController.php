<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $result = ['status' => 200];
        try {
            $result['data'] = $this->postService->getAllPost();
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->only([
            'title',
            'description',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->savePostData($data);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->getPostById($post);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($result, $result('status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->only([
            'title',
            'description'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->update($data, $post);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->postService->deletePost($post);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
