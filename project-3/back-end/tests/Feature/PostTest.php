<?php

namespace Tests\Feature;

use App\Helpers\ResponseHelper;
use App\Models\Likes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Post;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;

class PostTest extends TestCase
{

    // create tests
    public function test_create_wihtout_image_address(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/create', [
            'text' => 'Hello...!'
        ]);

        $response->assertStatus(400);
    }

    public function test_create_wihtout_text(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/create', [
            'image_address' => 'dart.png'
        ]);

        $response->assertStatus(200);
    }

    public function test_create_with_all_param(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/create', [
            'text' => 'Hello...!',
            'image_address' => 'dart.png'
        ]);

        $response->assertStatus(200);
    }

    // update tests
    public function test_update_wihtout_id(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/update', [
            'text' => 'Hello World!',
            'image_address' => 'hello.png'
        ]);

        $response->assertStatus(401);
    }

    public function test_update_with_all_param(): void
    {
        $post = Post::take(10)->get()->random();
        $post_id = $post->id;

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/update', [
            'id' => $post_id,
            'text' => 'Hello World!',
            'image_address' => 'hello.png'
        ]);

        $post = Post::where('id', $post_id)->get()[0];

        $response->assertStatus(200);
        $test_response = new ResponseHelper("Post ID $post_id has been successfully updated.", 200, false, $post->toArray());
       
        $response->assertJson($test_response->get());
    }

    // delete tests 
    public function test_delete_wihtout_id(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/delete', []);

        $response->assertStatus(400);
    }

    public function test_delete_with_all_param(): void
    {
        $post = $this->get_rand_post();

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/delete', [
            'id' => $post->id
        ]);

        $response->assertStatus(200);

        $test_response = new ResponseHelper("Post ID $post->id has been deleted successfully.", 200, false);
        $response->assertJson($test_response->get());
    }

    public function test_delete_deleted_id(): void
    {
        $trashed_post = $this->get_rand_trashed_post();

        $response = $this->postJson('api/post/delete', [
            'id' => $trashed_post->id
        ]);
        
        $response->assertStatus(401);

        $test_response = new ResponseHelper("Removing post $trashed_post->id failed!", 401);
        $response->assertJson($test_response->get());
    }

    public function test_delete_not_exist_id()
    {
        $id = $this->create_rand_not_exit_id();
        $response = $this->postJson('api/post/delete', [
            'id' => $id
        ]);

        $response->assertStatus(401);

        $test_response = new ResponseHelper("Removing post $id failed!", 401);
        $response->assertJson($test_response->get());
    }


    // show_all post tests
    public function test_show_all_posts_without_param()
    {
        $response = $this->postJson('api/post/');

        $count = 5;
        $slot = 1;

        $posts = Post::orderBy('created_at', 'DESC')->skip(($slot - 1) * $count)->take($count)->get();
        $response->assertStatus(200);

        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $posts->toArray());
        $response->assertJson($test_response->get());

    }

    public function test_show_all_posts_without_count()
    {   
        $max_slot = ((int) Post::count() / 5) + 1;

        $slot = rand(1, $max_slot);

        $response = $this->postJson('api/post/', [
            'slot' => $slot,
        ]);

        $count = 5;

        $posts = Post::orderBy('created_at', 'DESC')->skip(($slot - 1)*$count)->take($count)->get();

        $response->assertStatus(200);
        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $posts->toArray());
        $response->assertJson($test_response->get());
    }

    public function test_show_all_posts_without_slot()
    {
        $max_count = Post::count();

        $count = rand(1, $max_count);
        $slot = 1;

        $response = $this->postJson('api/post/', [
            'count' => $count,
        ]);

        $posts = Post::orderBy('created_at', 'DESC')->skip(($slot - 1)*$count)->take($count)->get();

        $response->assertStatus(200);
        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $posts->toArray());
        $response->assertJson($test_response->get());
    }

    public function test_show_all_posts_with_all_param(){
        $max_slot = ((int) Post::count() / 5) + 1;
        $max_count = Post::count();

        $slot = rand(1, $max_slot);
        $count = rand(1, $max_count);

        $response = $this->postJson('api/post/', [
            'count' => $count,
            'slot' => $slot
        ]);

        $posts = Post::orderBy('created_at', 'DESC')->skip(($slot - 1) * $count)->take($count)->get();
        $response->assertStatus(200);

        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $posts->toArray());
        $response->assertJson($test_response->get());
    }

    // show post test
    public function test_show_post_with_not_integer_post_id()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $post_id = $characters[rand(0, strlen($characters) - 1)];

        $response = $this->postJson("api/post/{$post_id}");
        $response->assertStatus(404);
    }

    public function test_show_post_with_not_exit_post_id()
    {
        $post_id = $this->create_rand_not_exit_id();
        $response = $this->postJson("api/post/{$post_id}");
        $response->assertStatus(404);
        $test_response = new ResponseHelper("Post ID is not exist.", 404);
        $response->assertJson($test_response->get());
    }

    public function test_show_post_with_all_param()
    {
        $post = Post::take(10)->get()->random();
        $post_id = $post->id;

        $response = $this->postJson("api/post/{$post_id}");
        $response->assertStatus(200);
        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $post->toArray());
        $response->assertJson($test_response->get());
    }

    // search post tests
    public function test_search_post_without_param()
    {
        $response = $this->postJson('api/post/search');

        $count = 5;
        $slot = 1;
        $posts = Post::orderBy('created_at', 'DESC')->skip(($slot - 1) * $count)->take($count)->get();
        $response->assertStatus(200);
        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $posts->toArray());
        $response->assertJson($test_response->get());
    }

    public function test_search_post_without_q_and_slot()
    {
        $max_count = Post::count();

        $count = rand(1, $max_count);
        $slot = 1;

        $response = $this->postJson('api/post/search/', [
            'count' => $count,
        ]);

        $posts = Post::orderBy('created_at', 'DESC')->skip(($slot - 1)*$count)->take($count)->get();
        $response->assertStatus(200);
        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $posts->toArray());
        $response->assertJson($test_response->get());
    }

    public function test_search_post_without_q_and_count()
    {
        $max_slot = ((int) Post::count() / 5) + 1;

        $slot = rand(1, $max_slot);

        $response = $this->postJson('api/post/search/', [
            'slot' => $slot,
        ]);

        $count = 5;

        $posts = Post::orderBy('created_at', 'DESC')->skip(($slot - 1)*$count)->take($count)->get();
        $response->assertStatus(200);
        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $posts->toArray());
        $response->assertJson($test_response->get());
    }

    public function test_search_post_without_q()
    {
        $max_slot = ((int) Post::count() / 5) + 1;
        $max_count = Post::count();

        $slot = rand(1, $max_slot);
        $count = rand(1, $max_count);

        $response = $this->postJson('api/post/search/', [
            'count' => $count,
            'slot' => $slot
        ]);

        $posts = Post::orderBy('created_at', 'DESC')->skip(($slot - 1) * $count)->take($count)->get();
        
        $response->assertStatus(200);
        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $posts->toArray());
        $response->assertJson($test_response->get());
    }

    public function test_search_post_with_all_param_and()
    {
        $max_slot = ((int) Post::count() / 5) + 1;
        $max_count = Post::count();

        $slot = rand(1, $max_slot);
        $count = rand(1, $max_count);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $q = $characters[rand(0, strlen($characters) - 1)];

        $response = $this->postJson('api/post/search/', [
            'q' => $q,
            'count' => $count,
            'slot' => $slot
        ]);

        $posts = Post::query()->when($q, function(Builder $builder) use ($q){
            $builder->where('text', 'like', "%{$q}%");
        })->orderBy('created_at', 'DESC')->skip(($slot - 1) * $count)->take($count)->get();
        
        $response->assertStatus(200);
        $test_response = new ResponseHelper("The request was made successfully.", 200, false, $posts->toArray());
        $response->assertJson($test_response->get());
    }

    // post add like tests
    public function test_post_add_like_without_post_id()
    {
        $response = $this->postJson("api/post//addLike/");

        $response->assertStatus(404);
    }

    public function test_post_add_like_with_not_integer_post_id()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
        $post_id = $characters[rand(0, strlen($characters)-1)];
        $response = $this->postJson("api/post/{$post_id}/addLike");

        $response->assertStatus(404);
    }

    public function test_post_add_like_with_not_exit_post_id()
    {
        $post_id = $this->create_rand_not_exit_id();

        $response = $this->postJson("api/post/{$post_id}/addLike");

        $response->assertStatus(404);
        $test_response = new ResponseHelper("Post ID $post_id is not exist.", 404);
        $response->assertJson($test_response->get());
    }

    public function test_post_add_like_with_all_param()
    {
        $post_id = Post::take(10)->get()->random()->id;

        $old_likes = Likes::where('post_id', $post_id)->count();

        $response = $this->postJson("api/post/{$post_id}/addLike/");

        $response->assertStatus(200);

        $test_response = new ResponseHelper("Post ID $post_id was liked.", 200, false);
        
        $response->assertJson($test_response->get());
        
        $new_likes = Likes::where('post_id', $post_id)->count();

        $this->assertEquals($old_likes + 1, $new_likes, 'old like count + 1 not equal new like count');

    }

    // get data for tests 
    public function get_posts()
    {   
        return Post::all();
    }

    public function get_rand_trashed_post()
    {
        $trashed_posts = Post::onlyTrashed()->get();
        return $trashed_posts->random();
    }

    public function get_rand_post()
    {
        $posts = $this->get_posts();
        return $posts->random();
    }

    public function create_rand_not_exit_id()
    {
        $posts = $this->get_posts()->sortBy('id');
        return $posts->last()->id + 1;
    }
}
