<?php

use App\Http\Controllers\Admin as ControllersAdmin;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CommentPostController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\Admin;
use App\Models\Course;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Purchase as PurchaseController;
use App\Models\Auther;

Route::get('/', function () {
    $courses = Course::take(6)->get();
    $posts = Post::take(4)->get();
    return view('Gallary', compact('courses' , 'posts'));
})->name('Gallary');

Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('courses/mycourse', [CourseController::class , 'mycourse'])->name('courses.mycourse');
Route::resource('courses', CourseController::class);
Route::resource('posts', PostController::class);
Route::resource('lessons', LessonController::class);
Route::delete('comments/destroy/post/{comment}', [CommentPostController::class , 'destroy'])->name('comments.post.destroy');


Route::get('/checkout/{course}', [PurchaseController::class, 'creditCheckout'])->name('credit.checkout');
Route::post('/checkout', [PurchaseController::class, 'purchase'])->name('products.purchase');
Route::get('/myproducts', [PurchaseController::class, 'myProducts'])->name('my.products');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');



Route::middleware([Admin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [ControllersAdmin::class, 'index'])->name('dashboard');


    Route::get('/users', [\App\Http\Controllers\Admin::class, 'users_admin'])->name('users.index');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin::class, 'users_delete'])->name('users.destroy');
    Route::post('/users/search', [\App\Http\Controllers\Admin::class, 'search_users'])->name('users.search');
    
    
    
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::get('/courses', [\App\Http\Controllers\Admin::class, 'index_Course'])->name('courses.index');
    Route::delete('/courses/{course}', [\App\Http\Controllers\Admin::class, 'delete_Course'])->name('courses.delete');
    Route::get('/courses/{course}', [\App\Http\Controllers\Admin::class, 'edit_Course'])->name('courses.edit');
    Route::get('/courses/search', [\App\Http\Controllers\Admin::class, 'Searh_Courses'])->name('courses.Search');
    

    Route::get('/posts', [PostController::class, 'index_admin'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::post('/posts/search', [PostController::class, 'search'])->name('posts.search');
    

    Route::get('/lessons', [\App\Http\Controllers\Admin::class, 'index_Lesson'])->name('lessons.index');
    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::get('/lessons/search', [\App\Http\Controllers\Admin::class, 'Searh_Lessons'])->name('lessons.Search');
    Route::get('/lessons/{lesson}', [\App\Http\Controllers\Admin::class, 'edit_Lesson'])->name('lessons.edit');
    Route::delete('/lessons/{lesson}', [\App\Http\Controllers\Admin::class, 'delete_Lesson'])->name('lessons.delete');

    
    Route::get('/puraches' , [\App\Http\Controllers\Admin::class, 'index_pruches'])->name('puraches.index');
    Route::get('/puraches/edit/{puraches}' , [\App\Http\Controllers\Admin::class, 'edit_pruches'])->name('puraches.edit');
    Route::post('/puraches/update/{puraches}' , [\App\Http\Controllers\Admin::class, 'update_pruches'])->name('puraches.update');
    Route::get('/puraches/search' , [\App\Http\Controllers\Admin::class, 'search_pruches'])->name('puraches.search');

    Route::get('/authers', [\App\Http\Controllers\Admin::class, 'index_authers'])->name('authers.index');
    Route::get('/authers/edit/{auther}', [\App\Http\Controllers\Admin::class, 'edit_authers'])->name('authers.edit');
    Route::put('/authers/update/{auther}', [\App\Http\Controllers\Admin::class, 'update_auther'])->name('authers.update');
    Route::delete('/authers/{auther}', [\App\Http\Controllers\Admin::class, 'delete_authers'])->name('authers.destroy');
    Route::post('/authers/search', [\App\Http\Controllers\Admin::class, 'search_authers'])->name('authers.search');
    

    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::get('/lessons/search', [\App\Http\Controllers\Admin::class, 'Searh_Lessons'])->name('lessons.Search');
    Route::get('/lessons/{lesson}', [\App\Http\Controllers\Admin::class, 'edit_Lesson'])->name('lessons.edit');
    Route::delete('/lessons/{lesson}', [\App\Http\Controllers\Admin::class, 'delete_Lesson'])->name('lessons.delete');
});
