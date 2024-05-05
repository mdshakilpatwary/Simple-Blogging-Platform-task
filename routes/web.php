<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogComment;
use App\Models\BlogPost;
use App\Models\Comment;


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
    $blogPost =BlogPost::orderBy('id','desc')->paginate(6);
    return view('welcome',compact('blogPost'));
});
Route::get('/single/blog/{slug}', function ($slug) {
   
    $blog =BlogPost::where('slug',$slug)->first();
    $id =$blog->id;
    $comments = Comment::where('blog_id', $id)->orderBy('id','desc')->get();
    
    return view('singleblog_page',compact('blog','comments'));
})->name('single.blog');
// user dashboard 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','role:User'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin dashboard 
Route::get('admin/dashboard', function () {
    return view('adminDashboard');
})->middleware(['auth', 'verified','role:Admin'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
Route::controller(BlogController::class)->group(function () {
    Route::get('/create/blog', 'index')->name('create.blog');
    Route::get('/manage/blog', 'manage')->name('manage.blog');
    Route::post('/store/blog', 'store')->name('store.blog');
    Route::get('/edit/blog/{slug}', 'edit')->name('edit.blog');
    Route::post('/update/blog/{id}', 'update')->name('update.blog');
    Route::get('/delete/blog/{id}', 'delete')->name('delete.blog');

});
});

// blog comment 

Route::middleware('auth')->group(function () {
    Route::controller(BlogComment::class)->group(function () {

        Route::post('/store/comment', 'store')->name('store.comment');
        Route::get('/delete/comment/{id}', 'delete')->name('delete.comment');
        
    
    });
});

require __DIR__.'/auth.php';
