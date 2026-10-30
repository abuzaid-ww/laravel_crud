<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    // $post = Post::all(); // for all post
    // $post = Post::where('user_id', auth()->id())->get(); //for the current user's post only
    $post = [];
    if(auth()->check()){
        $post = auth()->user()->userCoolPosts()->latest()->get();
    }
    return view('home', ['posts' => $post]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// blog post related class
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}',  [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}',  [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}',  [PostController::class, 'deletePost']);
