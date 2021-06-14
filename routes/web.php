<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FeedController;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// route for plain laravel chat
Route::get('/', function(){
    return view('index');
});
Route::post('/send-message', function(Request $request){
    event (new Message($request->username, $request->message));
});

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// feed
// Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
//     return Inertia::render('Feed/Index');
// })->name('feed');

Route::get('/', [FeedController::class, 'index'])
    ->name('feed')
    ->middleware('auth:sanctum', 'verified');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat/container');
})->name('chat');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat2', function () {
    return Inertia::render('Chat2/Container');
})->name('chat2');

Route::group(['middleware' => ['auth:sanctum']], function(){
	Route::get('/post', [PostController::class, 'index'])->name('post'); 
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create'); 
    Route::post('/post', [PostController::class, 'store'])->name('post.store'); 
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');  
    Route::patch('/post/{id}', [PostController::class, 'update'])->name('post.update'); 
	Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy'); 
});


Route::middleware('auth:sanctum')->get('/chat/rooms', [ChatController::class, 'rooms']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomId}/messages', [ChatController::class, 'messages']);
Route::middleware('auth:sanctum')->post('/chat/room/{roomId}/message', [ChatController::class, 'newMessage']);
// Route::middleware('auth:sanctum')->resource('/posts', PostController::class);
