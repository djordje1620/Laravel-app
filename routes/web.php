<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ColorContorllers;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternalController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RamController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
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

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/me', [MeController::class, 'index'])->name('me');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product');
Route::post('/products', [ProductController::class, 'filterProducts'])->name('products.filter');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');


Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    Route::middleware(['admin'])->group(function() {

        Route::get('/admin-panel', [AdminController::class, 'index'])->name('admin.panel');
        Route::post('/admin-panel', [AdminController::class, 'sort'])->name('admin.panel-sort');

        Route::get('/admin-products',[ProductController::class, 'adminShow'])->name('admin.products');
        Route::post('/admin-products-add',[ProductController::class, 'add'])->name('admin.add-product');
        Route::get('/admin-products-update/{id}',[ProductController::class, 'update'])->name('admin.add-update');
        Route::post('/admin-products-update',[ProductController::class, 'store'])->name('admin.add-product-store');
        Route::get('/admin-products-remove',[ProductController::class, 'remove'])->name('admin.product.remove');


        Route::get('/socials', [SocialController::class, 'index'])->name('admin.social');
        Route::post('/socials', [SocialController::class, 'show'])->name('admin.socials');
        Route::post('/socials.add', [SocialController::class, 'add'])->name('admin.socials.add');
        Route::get('/socials-activate/{id}', [SocialController::class, 'activate'])->name('admin.socials.activate');
        Route::get('/socials-deactivate/{id}', [SocialController::class, 'deactivate'])->name('admin.socials.deactivate');
        Route::get('/socials-delete/{id}', [SocialController::class, 'delete'])->name('admin.socials.delete');

        Route::post('/statistics', [AdminController::class, 'statistics'])->name('statistics');

        Route::get('/sliders', [SliderController::class, 'index'])->name('admin.slider');
        Route::get('/sliders/activate/{id}', [SliderController::class, 'activate'])->name('admin.slider.activate');
        Route::post('/sliders/update', [SliderController::class, 'store'])->name('admin.slider.store');

        Route::get('/colors', [ColorContorllers::class, 'index'])->name('admin.color');
        Route::post('/colors', [ColorContorllers::class, 'show'])->name('color');
        Route::post('/colors/add', [ColorContorllers::class, 'store'])->name('color-add');
        Route::get('/colors/delete/{id}', [ColorContorllers::class, 'delete'])->name('color-delete');

        Route::get('/screen', [ScreenController::class, 'index'])->name('admin.screen');
        Route::post('/screen', [ScreenController::class, 'show'])->name('screen');
        Route::post('/screen/add', [ScreenController::class, 'add'])->name('screen-add');
        Route::get('/screen/delete/{id}', [ScreenController::class, 'delete'])->name('screen-delete');

        Route::get('/rams', [RamController::class, 'index'])->name('admin.ram');
        Route::post('/rams', [RamController::class, 'show'])->name('ram');
        Route::post('/rams/add', [RamController::class, 'add'])->name('ram-add');
        Route::get('/rams/delete/{id}', [RamController::class, 'delete'])->name('ram-delete');

        Route::get('/internal', [InternalController::class, 'index'])->name('admin.internal');
        Route::post('/internal', [InternalController::class, 'show'])->name('internal');
        Route::post('/internal/add', [InternalController::class, 'add'])->name('internal-add');
        Route::get('/internal/delete/{id}', [InternalController::class, 'delete'])->name('internal-delete');

        Route::get('/users', [UserController::class, 'index'])->name('admin.user');

        Route::get('/about-info', [AboutController::class, 'show'])->name('admin.about-info');
        Route::post('/about-info', [AboutController::class, 'store'])->name('admin.about-info-store');

        Route::get('/brands', [BrandController::class, 'index'])->name('admin.brand');
        Route::post('/brands/store', [BrandController::class, 'store'])->name('admin.brand.store');
        Route::post('/brands/delete', [BrandController::class, 'delete'])->name('admin.brand.delete');

        Route::get('/discounts', [DiscountController::class, 'index'])->name('admin.discount');
        Route::post('/discounts/add', [DiscountController::class, 'add'])->name('admin.discount.add');
        Route::get('/discounts-active/{discount}{product}', [DiscountController::class, 'active'])->name('admin.discount.active');
        Route::get('/discounts-inactive/{discount}{product}', [DiscountController::class, 'inactive'])->name('admin.discount.inactive');

        Route::get('/baskets', [BasketController::class, 'index'])->name('admin.basket');
        Route::post('/baskets', [BasketController::class, 'sort'])->name('admin.sort-basket');
        Route::post('/baskets/filter', [BasketController::class, 'filter'])->name('admin.filter-basket');


    });

});

Route::middleware(['notauth'])->group(function() {
    Route::get('/registration', [RegisterController::class, 'showReg'])->name('registration');
    Route::post('/registration', [RegisterController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLog'])->name('login');
    Route::post('/logIn', [AuthController::class, 'login'])->name('logIn');
});
