<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;

// Client Controllers
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\CartController;

/*
|--------------------------------------------------------------------------
| CLIENT
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Chi tiết sản phẩm
Route::get('/product/{slug}', [ClientProductController::class, 'show'])
    ->name('product.show');

// Danh mục
Route::get('/category/{slug}', [ClientProductController::class, 'category'])
    ->name('products.category');

// Thương hiệu
Route::get('/brand/{slug}', [ClientProductController::class, 'brand'])
    ->name('products.brand');

// Tìm kiếm
Route::get('/search', [ClientProductController::class, 'search'])
    ->name('products.search');

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

// Giỏ hàng
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

// Thêm sản phẩm vào giỏ
Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

// Cập nhật số lượng
Route::post('/cart/update', [CartController::class, 'update'])
    ->name('cart.update');

// Xóa sản phẩm
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

// Trang thanh toán
Route::get('/checkout', [CartController::class, 'checkout'])
    ->name('checkout');

// Lưu đơn hàng
Route::post('/checkout', [CartController::class, 'store'])
    ->name('checkout.store');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Đăng nhập
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

        // Quên mật khẩu
        Route::get('/forgotpass', [AuthController::class, 'forgotPassword'])->name('forgotpass');
        Route::post('/forgotpass', [AuthController::class, 'postForgotPassword'])->name('forgotpass.post');

        Route::middleware('auth')->group(function () {

            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

            // Đổi mật khẩu
            Route::get('/change-password', [AuthController::class, 'changePassword'])
                ->name('change-password');

            Route::post('/change-password', [AuthController::class, 'postChangePassword'])
                ->name('change-password.post');

            // Đăng xuất
            Route::post('/logout', [AuthController::class, 'logout'])
                ->name('logout');

            // Thùng rác & khôi phục danh mục (khai báo trước resource categories)
            Route::get('categories/trash', [CategoryController::class, 'trash'])
                ->name('categories.trash');
            Route::post('categories/restore-all', [CategoryController::class, 'restoreAll'])
                ->name('categories.restoreAll');
            Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])
                ->name('categories.restore');
            Route::delete('categories/force-delete-all', [CategoryController::class, 'forceDeleteAll'])
                ->name('categories.forceDeleteAll');
            Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])
                ->name('categories.forceDelete');

            // CRUD
            Route::resource('categories', CategoryController::class);
            Route::resource('brands', BrandController::class);
            Route::resource('products', ProductController::class);
            Route::resource('posts', PostController::class);
            Route::resource('users', UserController::class);

            // Xóa ảnh sản phẩm
            Route::delete(
                'products/{product}/images/{image}',
                [ProductController::class, 'deleteImage']
            )->name('products.images.destroy');

            // Đơn hàng
            Route::resource('orders', OrderController::class);
            Route::patch('orders/{id}/status', [OrderController::class, 'updateStatus'])
                ->name('orders.updateStatus');
        });
    });
