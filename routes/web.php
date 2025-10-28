<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class , 'home' ] )->name('index');
Route::get('/why',[UserController::class , 'why' ] )->name('why');
Route::get('/testimonials',[UserController::class , 'testi' ] )->name('testi');
Route::get('/contact',[UserController::class , 'contact' ] )->name('contact');


Route::get('/dashboard',[UserController::class , 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/product_details/{product}',[UserController::class , 'productDetails'])->name('product_details');
Route::get('/all_products',[UserController::class , 'allProducts'])->name('allproducts');
Route::get('/addToCard/{product}',[UserController::class , 'addToCard'])->middleware(['auth', 'verified'])->name('add_to_card');
Route::get('/card_product',[UserController::class , 'cardProduct'])->middleware(['auth', 'verified'])->name('cardproduct');
Route::delete('/delete_card_product/{card}', [UserController::class, 'deleteCardProduct'])->middleware(['auth', 'verified'])->name('deletecardproduct');
Route::post('/confirm_order',[UserController::class , 'confirmOrder'])->middleware(['auth', 'verified'])->name('confirm_order');
Route::get('/my_orders',[UserController::class , 'myOrders'])->middleware(['auth', 'verified'])->name('myorders');
Route::get('/stripe/{price}', [UserController::class, 'stripe'])->middleware(['auth', 'verified'])->name('stripe');
Route::post('/stripe_post',[UserController::class , 'postStripe'])->middleware(['auth', 'verified'])->name('poststripe');
Route::post('/products/{product}/comment', [UserController::class, 'addComment'])->name('addcomment');
Route::delete('/delete_comment_product/{comment}', [UserController::class, 'destroyComment'])->middleware(['auth', 'verified'])->name('destroycomment');
Route::post('/like_product/{product}', [UserController::class, 'likeProduct'])->middleware(['auth', 'verified'])->name('likeproduct');








Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','admin')->group(function () {
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    Route::delete('/delete_category/{category}', [AdminController::class, 'deleteCategory'])->name('admin.deletecategory');
    Route::put('/category/{category}', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');
    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('admin.addproduct');
    Route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');
    Route::get('/view_product', [AdminController::class, 'viewProduct'])->name('admin.viewproduct');
    Route::delete('/delete_product/{product}', [AdminController::class, 'deleteProduct'])->name('admin.deleteproduct');
    Route::get('/product/edit/{product}', [AdminController::class, 'editProduct'])->name('admin.editproduct');
    Route::put('/product/{product}', [AdminController::class, 'updateProduct'])->name('admin.updateproduct');
    Route::get('/search_product', [AdminController::class, 'searchProduct'])->name('admin.searchproduct');
    Route::get('/view_orders', [AdminController::class, 'viewOrders'])->name('admin.vieworders');
    Route::get('/search_order', [AdminController::class, 'searchOrder'])->name('admin.searchorder');
    Route::post('/change_status/{order}', [AdminController::class, 'changeStatus'])->name('admin.changestatus');
    Route::get('/download_pdf/{order}', [AdminController::class, 'downloadPdf'])->name('admin.downloadpdf');




});


require __DIR__.'/auth.php';