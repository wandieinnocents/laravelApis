<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all posts api
        // return Post::all();

        $posts = Post::get()->toJson(JSON_PRETTY_PRINT);
        return response($posts, 200);
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
       
       $post = new Post;
       $post->title = $request->title;
       $post->content = $request->content;
       $post->save();

    //return json reponse
        return response()->json([
            "message" => "post created successfuly"
        ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return a single post from the database
        if (Post::where('id', $id)->exists()) {
            $post = Post::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($post, 200);
          } else {
            //   if no post in the database
            return response()->json([
              "message" => "Post not found"
            ], 404);
          
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // check if post exists in the database , 
        if (Post::where('id', $id)->exists()) {
            // find post by id
            $post = Post::find($id);
            // validation added incase only a single field needs to be updated
            $post->title = is_null($request->title) ? $post->title : $request->title;
            $post->content = is_null($request->content) ? $post->content : $request->content;
            $post->save();
    
            // if it exists return 
            return response()->json([
                "message" => "Post updated successfully"
            ], 200);
            } else {
                // if not post in the database
            return response()->json([
                "message" => "Post not found"
            ], 404);
            
        }
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // check if post exists
        if(Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();
            
            //if it exists return
            return response()->json([
              "message" => "Post successfuly deleted"
            ], 202);
          } else {
            //if post does not exists return
            return response()->json([
              "message" => "Post not found"
            ], 404);
          }
        }

    
}
