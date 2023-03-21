<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();

        return response()->json([
            'blogs' => $blogs,
            "status" => true,
        ], 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $blog = Blog::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Blog created successfully!",
            'blog' => $blog
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return response()->json([
            'status' => true,
            'blog' => $blog,
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogRequest $request, Blog $blog)
    {
        if ($request->user()->cannot('update', $blog)) {
            return response()->json([
                'status' => false,
            ], 403);
        }

        $blog->update($request->all());
        return response()->json([
            'status' => true,
            'message' => "Blog updated successfully!",
            'blog' => $blog
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Blog $blog)
    {
        if ($request->user()->cannot('delete', $blog)) {
            return response()->json([
                'status' => false,
            ], 403);
        }

        $blog->delete();

        return response()->json([
            'status' => true,
            'message' => "Blog Deleted successfully!",
        ], 204);
    }
}
