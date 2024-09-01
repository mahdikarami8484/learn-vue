<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
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
            
            $response = new ResponseHelper("The request was made successfully.", 200, false, $posts->items());
            return $response->send();
        } catch(Exception $e){
            $response = new ResponseHelper("Error: ".$e->getMessage(), 400);
            return $response->send();
        }
    }

    public function show($post_id)
    {
        try{
            $post = Post::where('id', $post_id);
            $count = $post->count();
            if($count <= 0)
            {
                $response = new ResponseHelper("Post ID is not exist.", 404);
                return $response->send();
            }       

            $post = $post->get();

            $response = new ResponseHelper("The request was made successfully.", 200, false, $post[0]->toArray());
            return $response->send();
        }catch(Exception $e)
        {
            $response = new ResponseHelper("Error: ".$e->getMessage(), 400);
            return $response->send();
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
            
            $response = new ResponseHelper("The request was made successfully.", 200, false, $posts->items());
            return $response->send();
        }catch(Exception $e){
            $response = new ResponseHelper("Error: ".$e->getMessage(), 400);
            return $response->send();
        }
    }

    public function addLike($post_id)
    {
        $count = Post::where('id', $post_id)->count();

        if($count <= 0)
        {
            $response = new ResponseHelper("Post ID $post_id is not exist.", 404);
            return $response->send($response->get());
        }

        try{
            Likes::create(['post_id' => $post_id]);
            $response = new ResponseHelper("Post ID $post_id was liked.", 200, false);
            
            return $response->send($response->get());
        }catch(Exception $e){
            $response = new ResponseHelper("Error: ".$e->getMessage(), 400);
            return $response->send();
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

            $response = new ResponseHelper("The request was made successfully.", 200, false, $post->toArray());
            return $response->send();
        } catch(Exception $e) {
            $response = new ResponseHelper("Error: ".$e->getMessage(), 400);
            return $response->send();
        }
        
    }

    public function update(Request $request)
    {
        $inputs = $request->only([
            'text',
            'image_address',
        ]);

        try {
            $post = Post::where(['id' => $request->id]);
            $status = $post->update($inputs);
            
            $post_id = $request->id;
            $post = $post->get();
            
            if($status){
                $response = new ResponseHelper("Post ID $post_id has been successfully updated.", 200, false, $post[0]->toArray());
                return $response->send();
            }

            $response = new ResponseHelper("Updating post $post_id failed!", 401);
            return $response->send();
        } catch(Exception $e) {
            $response = new ResponseHelper("Error: ".$e->getMessage(), 400);
            return $response->send();
        }
    }

    public function delete(Request $request)
    {
        $inputs = $request->only([
            'id',
        ]);

        try {
            $status = Post::where(['id' => $inputs['id']])->delete();
            $post_id = $inputs['id'];

            if($status){
                $response = new ResponseHelper("Post ID $post_id has been deleted successfully.", 200, false);
                return $response->send();
            }

            $response = new ResponseHelper("Removing post $post_id failed!", 401);
            return $response->send();
        } catch(Exception $e) {
            $response = new ResponseHelper("Error: ".$e->getMessage(), 400);
            return $response->send();
        }
    }
}
