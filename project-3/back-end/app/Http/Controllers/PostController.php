<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;
use App\Models\Post;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function showAll(Request $request)
    {
        $count = data_get($request, 'count', 5);
        try {
            $posts = Post::orderBy('created_at', 'DESC')->paginate($perPage = $count, $columns = ['*'], $pageName = 'slot');
            return Response()->json($posts->items(), 200);
        } catch(Exception $e){
            return Response()->json($e, 400);
        }

    }

    public function search(Request $request)
    {
        $count = data_get($request, 'count', 5);
        try{
            if($request->q === null) return $this->showAll($request);
            $posts = Post::query()->when($request->q, function(Builder $builder) use ($request){
                $builder->where('text', 'like', "%{$request->q}%");
            })->orderBy('created_at', 'DESC')->paginate($perPage = $count, $columns = ['*'], $pageName = 'slot');
            return Response()->json($posts->items(), 200);
        }catch(Exception $e){
            return Response()->json($e, 400);
        }
    }

    public function addLike($post_id)
    {

        $count = Post::where('id', $post_id)->count();

        if($count <= 0)
        {
            return Response()->json("post $post_id not exist.", 401);
        }

        try{
            Likes::create(['post_id' => $post_id]);
            return Response()->json("like added to post $post_id", 200);
        }catch(Exception $e){
            return Response()->json($e, 400);
        }
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
