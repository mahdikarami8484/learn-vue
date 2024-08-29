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
    Route::post('/', [PostController::class, 'show']);

    // create post
    Route::post('/create', [PostController::class, 'create']);

    // update post
    Route::post('/update', [PostController::class, 'update']);

    // delete post
    Route::post('/delete', [PostController::class, 'delete']);
});


