<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Post;
use Tests\TestCase;

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
        $post = $this->get_rand_post();

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/update', [
            'id' => $post->id,
            'text' => 'Hello World!',
            'image_address' => 'hello.png'
        ]);

        $response->assertStatus(200);
    }

    // delete tests 
    public function test_delete_wihtout_id(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/delete', []);

        $response->assertStatus(400);
    }

    public function test_delete_wiht_all_param(): void
    {
        $post = $this->get_rand_post();

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/delete', [
            'id' => $post->id
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_deleted_id(): void
    {
        $trashed_post = $this->get_rand_trashed_post();

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/delete', [
            'id' => $trashed_post->id
        ]);

        $response->assertStatus(401);
    }

    public function test_delete_not_exist_id()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/delete', [
            'id' => $this->create_rand_not_exit_id()
        ]);

        $response->assertStatus(401);
    }


    // show post tests
    public function test_show_posts()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('api/post/');

        $posts = Post::orderBy('created_at', 'DESC');
        $response->assertJson(Response()->json($posts, 200));
        $response->assertStatus(200);
    }

    // get data for tests 
    public function get_posts()
    {   
        return Post::all();
    }

    public function get_rand_trashed_post()
    {
        $trashed_posts = Post::withTrashed()->get();
        return $trashed_posts->random();
    }

    public function get_rand_post()
    {
        $posts = $this->get_posts();
        return $posts->random();
    }

    public function create_rand_not_exit_id()
    {
        $posts = $this->get_posts()->sortBy('id');;
        return $posts->last()->id + 1;
    }
}
