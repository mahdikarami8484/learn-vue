<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Exception;

class PostController extends Controller
{
    public function show()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        return Response()->json($posts, 200);
    }

    public function create(Request $request)
    {
        $inputs = $request->only([
            'text',
            'image_address',
        ]);

        try {
            $post = Post::create($inputs);
            return Response()->json($post, 200);
        } catch(Exception $e) {
            return Response()->json($e, 400);
        }
        
    }

    public function update(Request $request)
    {
        $inputs = $request->only([
            'text',
            'image_address',
        ]);

        try {
            $post = Post::where(['id' => $request['id']])->update($inputs);
            if($post) return Response()->json("the post updated successfuly.", 200);
            return Response()->json("updating the post failed!!", 401);
        } catch(Exception $e) {
            return Response()->json($e, 400);
        }
    }

    public function delete(Request $request)
    {
        $inputs = $request->only([
            'id',
        ]);

        try {
            $status = Post::where(['id' => $inputs['id']])->delete();

            if($status) return Response()->json("the post removed successfuly.", 200);

            return Response()->json(["message" => "removing the post failed!!"], 401);
        } catch(Exception $e) {
            return Response()->json($e, 400);
        }
    }
}
