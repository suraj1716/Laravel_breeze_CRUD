<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Normal_User\PController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\SocialateController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['can:role-list'])->group(function () {
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    // Add other routes that require 'role-list' permission
});


// ---------normal---------------


// Route::resource('category',CategoryController::class);
// Route::resource('products',ProductController::class);
// Route::resource('roles',RoleController::class);
// Route::resource('users',UserController::class);

// ---------admins---------------
// Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

//     Route::resource('category', CategoryController::class);
//     Route::resource('products', ProductController::class);

//     Route::resource('roles', RoleController::class);

//     Route::resource('users', UserController::class);
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';


// Route::prefix('api')->group(function () {
//     Route::get('categories', [ApiCategoryController::class, 'index']);
//     Route::post('categories', [ApiCategoryController::class, 'store']);
//     Route::get('categories/{category}', [ApiCategoryController::class, 'show']);
//     Route::put('categories/{category}', [ApiCategoryController::class, 'update']);
//     Route::delete('categories/{category}', [ApiCategoryController::class, 'destroy']);
// });



Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');



Route::controller(SocialateController::class)->group(function () {
    Route::get('auth/google', [SocialateController::class, 'googleLogin'])->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
});
