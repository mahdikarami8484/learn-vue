<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/hello', function(){
    return Response()->json('Hello World');
});


// user api 
Route::prefix('user')->group(function(){
    // show users
    Route::post('/', function(){
        return Response()->json('Users List');
    });
});

// post api 
Route::prefix('post')->group(function(){
    // show posts
    Route::post('/', [PostController::class, 'showAll']);

    // search post
    Route::post('/search', [PostController::class, 'search']);

    // like post
    Route::post('/{post_id}/addLike', [PostController::class, 'addLike'])->where('post_id', '[0-9]+');


    // create post
    Route::post('/create', [PostController::class, 'create']);

    // update post
    Route::post('/update', [PostController::class, 'update']);

    // delete post
    Route::post('/delete', [PostController::class, 'delete']);
});

// post api get ( for debug )
Route::prefix('post')->group(function(){
    // show posts
    Route::get('/', [PostController::class, 'showAll']);

    // search post
    Route::get('/search', [PostController::class, 'search']);

    // like post
    Route::get('/{post_id}/addLike', [PostController::class, 'addLike'])->where('post_id', '[0-9]+');

    // create post
    Route::get('/create', [PostController::class, 'create']);

    // update post
    Route::get('/update', [PostController::class, 'update']);

    // delete post
    Route::get('/delete', [PostController::class, 'delete']);
});


