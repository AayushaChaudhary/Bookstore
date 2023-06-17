<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Middleware\PDFMiddleware;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::get('/search', [FrontendController::class, 'search'])->name('search');
Route::get('/books', [FrontendController::class, 'books'])->name('books');
Route::get('/new-arrivals', [FrontendController::class, 'arrivals'])->name('new');
Route::get('/category/{category}', [FrontendController::class, 'category'])->name('categories');
Route::get('/categories', [FrontendController::class, 'categories'])->name('category');
Route::get('/author/{author}', [FrontendController::class, 'author'])->name('author');
Route::get('/book/{book}', [FrontendController::class, 'book'])->name('book');
Route::get('/book/{book}/preview', [FrontendController::class, 'preview'])
    ->middleware(PDFMiddleware::class)
    ->name('preview');
Route::post('/contact', [SiteController::class, 'contactForm'])->name('contact');

// Cart and Orders
Route::middleware('auth')->group(function () {
    // Cart Management
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/{book}', [CartController::class, 'create'])->name('cart.add');
    Route::post('/cart/changeQuantity/{cart}', [CartController::class, 'quantity'])->name('cart.quantity');
    Route::post('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [CartController::class, 'placeOrder'])->name('checkout.store');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/edit', [ProfileController::class, 'update'])->name('update');
        Route::get('/password', [ProfileController::class, 'password'])->name('password');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
        Route::get('/orders/{order}', [ProfileController::class, 'order'])->name('order');
        Route::delete('/orders/{order}', [ProfileController::class, 'cancelOrder'])->name('order.cancel');
    });
});


Route::get('/home', [SiteController::class, 'home'])
    ->name('home')
    ->middleware('auth');
Route::middleware(['auth', 'admin'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\AdminController::class, 'index'])->name('index');

    //CRUD
    Route::resource('users', Admin\UserController::class)->only(['index']);
    Route::resource('categories', Admin\CategoryController::class);
    Route::resource('authors', Admin\AuthorController::class);
    Route::resource('publishers', Admin\PublisherController::class);
    Route::resource('books', Admin\BookController::class);
    // Custom Logic for Order->Books
    Route::controller(Admin\OrderController::class)
        ->prefix('orders')
        ->name('orders.')
        ->group(function () {
            Route::post('{order}/status', 'changeStatus')->name('status');
            Route::post('{order}/books', 'addBook')->name('books.store');
            Route::get('{order}/{book_order}/quantity', 'editQuantity')->name('books.quantity');
            Route::post('{order}/{book_order}/quantity', 'updateQuantity');
            Route::get('{order}/{book_order}/delete', 'deleteBook')->name('books.delete');
        });
    Route::resource('orders', Admin\OrderController::class);
    Route::resource('purchases', Admin\PurchaseController::class);
    Route::resource('stocks', Admin\StockController::class);
    Route::resource('suppliers', Admin\SupplierController::class);
    Route::resource('sales', Admin\SaleController::class)->only(['index', 'show']);
    Route::resource('messages', Admin\MessageController::class);
});
