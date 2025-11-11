<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::get('/home',[AdminController::class,'index'])->name('home');


Route::get('/', [HomeController::class, 'index']);

//Admin part
Route::get('/category_page', [CategoryController::class, 'category_page'])->middleware(['auth', 'admin']);

Route::post('/add_category', [CategoryController::class, 'add_category'])->middleware(['auth', 'admin']);

Route::get('/delete_category/{id}', [CategoryController::class, 'delete_category'])->middleware(['auth', 'admin']);

Route::get('/edit_category/{id}', [CategoryController::class, 'edit_category'])->middleware(['auth', 'admin']);

Route::post('/update_category/{id}', [CategoryController::class, 'update_category'])->middleware(['auth', 'admin']);

Route::get('/add_book', [BookController::class, 'add_book'])->middleware(['auth', 'admin']);

Route::post('/store_book', [BookController::class, 'store_book'])->middleware(['auth', 'admin']);

Route::get('/show_book', [BookController::class, 'show_book'])->middleware(['auth', 'admin']);

Route::get('/book_delete/{id}', [BookController::class, 'book_delete'])->middleware(['auth', 'admin']);

Route::get('/edit_book/{id}', [BookController::class, 'edit_book'])->middleware(['auth', 'admin']);

Route::post('/update_book/{id}', [BookController::class, 'update_book'])->middleware(['auth', 'admin']);

Route::get('/borrow_request', [BorrowController::class, 'borrow_request'])->middleware(['auth', 'admin']);

Route::get('/borrow-filter', [BorrowController::class, 'filter'])->name('borrow.filter');
Route::post('/borrow-search', [BorrowController::class, 'search'])->name('borrow.search');

Route::get('/approve_book/{id}', [BorrowController::class, 'approve_book'])->middleware(['auth', 'admin']);


Route::get('/rejected_book/{id}', [BorrowController::class, 'rejected_book'])->middleware(['auth', 'admin']);


// user part
Route::get('/add_cart/{id}', [CartController::class, 'add_cart'])->middleware(['auth']);


Route::get('/show_cart', [CartController::class, 'show_cart'])->middleware(['auth']);



Route::get('/remove_cart/{id}', [CartController::class, 'remove_cart'])->middleware(['auth']);


Route::get('/confirm_order', [BorrowController::class, 'confirm_order'])->middleware(['auth']);


Route::get('/book_history', [HomeController::class, 'book_history'])->middleware('auth');


Route::get('/cancel_request/{id}', [HomeController::class, 'cancel_request'])->middleware('auth');


Route::get('returned_book/{id}', [HomeController::class, 'returned_book'])->middleware(['auth']);



Route::get('/explore', [HomeController::class, 'explore']);


Route::get('/book_details/{id}', [HomeController::class, 'book_details']);





Route::post('/search', [HomeController::class, 'search'])->name('search');

Route::controller(StripeController::class)->group(function(){
    Route::get('stripe/{totalprice}','stripe');
    Route::post('stripe/{totalprice}','stripePost')->name('stripe.post');

});

