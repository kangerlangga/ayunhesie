<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublikController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

// Route::get('/404', function () {
//     $judul = 'Page Not Found';
//     return view('pages.error.404', compact('judul'));
// });

Route::get('/', [PublikController::class, 'home'])->name('home.publik');
Route::get('/about', [PublikController::class, 'about'])->name('about.publik');
Route::get('/collection', [PublikController::class, 'collection'])->name('collection.publik');
Route::get('/collection/buy/{id}', [PublikController::class, 'buy'])->name('collection.buy');
Route::post('/collection/buy/submit', [PublikController::class, 'cstore'])->name('buy.submit');
Route::get('/blog', [PublikController::class, 'blog'])->name('blog.publik');
Route::get('/blog/detail/{id}', [BlogController::class, 'show'])->name('blog.detail');
Route::get('/check/order/number/{id}', [PublikController::class, 'checkOrder'])->name('check.order');
Route::get('/check/payment/receipt/{id}', [PublikController::class, 'checkReceipt'])->name('check.receipt');
Route::get('/edit/payment/receipt/{id}', [PublikController::class, 'editReceipt'])->name('edit.receipt');
Route::post('/update/payment/receipt/{id}', [PublikController::class, 'updateReceipt'])->name('update.receipt');

Route::get('/get-product-price/{code}', [ProductController::class, 'getProductPrice']);

// Rute Admin
Route::middleware(['auth', 'verified', CheckAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dash');
    Route::get('/assets2/visitors-stats', [AdminController::class, 'getVisitorsStatistics']);
    Route::get('/admin/profile/edit', [AdminController::class, 'editProf'])->name('prof.edit');
    Route::post('/admin/profile/updateProfile', [AdminController::class, 'updateProf'])->name('prof.update');
    Route::get('/admin/profile/editPass', [AdminController::class, 'editPass'])->name('prof.edit.pass');
    Route::post('/admin/profile/updatePass', [AdminController::class, 'updatePass'])->name('prof.update.pass');

    Route::get('/admin/home', [HomeSliderController::class, 'index'])->name('home.data');
    Route::get('/admin/home/add', [HomeSliderController::class, 'create'])->name('home.add');
    Route::post('/admin/home/store', [HomeSliderController::class, 'store'])->name('home.store');
    Route::get('/admin/home/edit/{id}', [HomeSliderController::class, 'edit'])->name('home.edit');
    Route::post('/admin/home/update/{id}', [HomeSliderController::class, 'update'])->name('home.update');
    Route::get('/admin/home/delete/{id}', [HomeSliderController::class, 'destroy'])->name('home.delete');

    Route::get('/admin/product', [ProductController::class, 'index'])->name('product.data');
    Route::get('/admin/product/add', [ProductController::class, 'create'])->name('product.add');
    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/admin/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/admin/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::get('/admin/blog', [BlogController::class, 'index'])->name('blog.data');
    Route::get('/admin/blog/add', [BlogController::class, 'create'])->name('blog.add');
    Route::post('/admin/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/admin/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/admin/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/admin/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');

    Route::get('/admin/comment', [CommentController::class, 'index'])->name('comment.data');
    Route::get('/admin/comment/add', [CommentController::class, 'create'])->name('comment.add');
    Route::post('/admin/comment/store', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/admin/comment/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::post('/admin/comment/update/{id}', [CommentController::class, 'update'])->name('comment.update');
    Route::get('/admin/comment/delete/{id}', [CommentController::class, 'destroy'])->name('comment.delete');

    Route::get('/admin/order', [OrderController::class, 'index'])->name('order.data');
    Route::get('/admin/order/add', [OrderController::class, 'create'])->name('order.add');
    Route::post('/admin/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/admin/order/detail/{id}', [OrderController::class, 'show'])->name('order.detail');
    Route::get('/admin/order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('/admin/order/update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::get('/admin/order/delete/{id}', [OrderController::class, 'destroy'])->name('order.delete');

    Route::get('/admin/user', [UserController::class, 'index'])->name('user.data');
    Route::get('/admin/user/add', [UserController::class, 'create'])->name('user.add');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/admin/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/admin/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/admin/user/resetPass/{id}', [UserController::class, 'resetPass'])->name('user.resetpass');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
