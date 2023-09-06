<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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


// Login , Register
Route::middleware('admin_auth')->group( function() {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Admin

    Route::middleware(['admin_auth'])->group(function () {
        // Admin-> Category
        Route::group(
            ['prefix' => 'category'],
            function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        }
        );

        // Admin-> account
        Route::group(
            ['prefix' => 'admin'],
            function (){
                // password ပိုင်းဆိုင်ရာ
                Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
                Route::post('change/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');

                // ‌account profile ပိုင်းဆိုင်ရာ
                Route::get('profile', [AdminController::class, 'profile'])->name('admin#profilePage');
                Route::get('editProfile', [AdminController::class, 'editProfile'])->name('admin#editProfile');
                Route::post('updateProfile/{id}', [AdminController::class, 'updateProfile'])->name('admin#updateProfile');

                // account list ပိုင်းဆိုင်ရာ
                Route::get('list', [AdminController::class,'list'])->name('admin#list');
                Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
                Route::get('change/role', [UserListController::class, 'changeRole'])->name('admin#change');
            }
        );

        // Product ပိုင်းဆိုင်ရာ
        Route::group(
            ['prefix' => 'product'],
            function () {
                Route::get('list', [ProductController::class, 'list'])->name('product#list');
                Route::get('createPage',[ProductController::class, 'createPage'])->name('product#createPage');
                Route::post('create', [ProductController::class, 'create'])->name('product#create');
                Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
                Route::get('detail/{id}', [ProductController::class, 'detailPage'])->name('product#detailPage');
                Route::get('edit/{id}', [ProductController::class, 'editPage'])->name('product#editPage');
                Route::post('update', [ProductController::class, 'update'])->name('product#update');
            }
        );

        // User List ပိုင်းဆိုင်ရာ
        Route::group(['prefix' => 'user'], function(){
            Route::get('/list', [UserListController::class, 'list'])->name('admin#userList');
            Route::get('/change/role', [UserListController::class, 'changeRole'])->name('admin#userChangeRole');
        });

        // Order ပိုင်းဆိုင်ရာ
        Route::group(
            ['prefix' => 'order'],
            function () {
                Route::get('/list', [OrderController::class, 'list'])->name('order#list');
                Route::get('change/status', [OrderController::class, 'changeStatus'])->name('order#changeStatus');
                Route::get('ajax/change/status', [OrderController::class, 'ajaxChangeStatus'])->name('order#ajaxChangeStatus');
                Route::get('orderInfo/{orderCode}', [OrderController::class, 'orderInfo'])->name('admin#orderInfo');
            }
        );

        // contact ပိုင်းဆိုင်ရာ
        Route::get('message', [ContactController::class, 'showMessage'])->name('contact#message');
        Route::get('message/details/{id}', [ContactController::class, 'messageDetail'])->name('contact#messageDetail');
    });

    // Direct User Home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'], function() {
        Route::get('/home', [UserController::class,'homePage'])->name('user#homePage');
        Route::get('/filter/{id}', [UserController::class,'filter'])->name('user#filter');
        Route::get('/history', [UserController::class, 'history'])->name('user#history');

        Route::prefix('pizza')->group( function () {
            Route::get('/detail/{id}', [UserController::class, 'pizzaDetail'])->name('user#pizzaDetail');
        });

        Route::prefix('cart')->group( function () {
            Route::get('list', [Usercontroller::class, 'cartList'])->name('user#cartList');
        });

        Route::group(['prefix' => 'password'],
        function() {
            Route::get('changePassword', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('changePasswored', [UserController::class, 'changePassword'])->name('user#changePassword');
        });

        Route::group(['prefix' => 'account'],
        function() {
            Route::get('profile', [UserController::class, 'profilePage'])->name('user#profilePage');
            Route::post('edit/{id}', [UserController::class,'editProfile'])->name('user#editProfile');
        });

        Route::prefix('ajax')->group(function() {
            Route::get('product/list',[AjaxController::class,'productList'])->name('ajanx#productList');
            Route::get('addToCart', [Ajaxcontroller::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('order', [AjaxController::class, 'order'])->name('Ajax#order');
            Route::get('clear/cart', [AjaxController::class, 'clearCart'])->name('Ajax#clearCart');
            Route::get('clear/current/product', [AjaxController::class, 'clearCurrentProduct'])->name('Ajax#clearCurrentProduct');
            Route::get('increase/viewCount', [AjaxController::class, 'increaseViewCount'])->name('Ajax#increaseViewCount');
        });


        // Contact ပိုင်းဆိုင်ရာ
        Route::group(['prefix' => 'contact'],
        function() {
            Route::get('form', [ContactController::class, 'contactForm'])->name('user#contactForm');
        });
    });
});
