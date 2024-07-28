<?php

use App\Http\Controllers\CreatePotsController;
use App\Http\Controllers\CreateStoryController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimelineController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/home', [TimelineController::class,"index"])->middleware(['auth', 'verified'])->name('home');

Route::get('/feed',[FeedController::class,"index"])->middleware(['auth', 'verified'])->name('feed');
Route::post("/create_post",[CreatePotsController::class,"store"])->middleware(['auth', 'verified'])->name('create_post');
Route::post("/create_story",[CreateStoryController::class,"store"])->middleware(['auth', 'verified'])->name('create_story');
Route::get("/send_friend_request/{id}",[FriendController::class,"sendRequest"])->middleware(['auth', 'verified'])->name('send_friend_request');
Route::get('/requests/{id}/accept', [FriendController::class, 'acceptRequest'])->name('acceptRequest');
Route::get('/requests/{id}/decline', [FriendController::class, 'rejectRequest'])->name('declineRequest');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
