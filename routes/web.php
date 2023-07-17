<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;

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

Route::middleware(['languages'])->group(function () {
    Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/empresa', [Controllers\CompanyController::class, 'index'])->name('company');
    Route::get('/produtos', [Controllers\ProductsController::class, 'index'])->name('products');
    Route::get('/detalhe', [Controllers\ProductsController::class, 'details'])->name('detalhe');
    Route::get('/produto/{category}', [Controllers\ProductsController::class, 'index'])->name('products.category');
    Route::get('/produtos/{slug}', [Controllers\ProductsController::class, 'details'])->name('products.details');
    Route::get('/blog', [Controllers\BlogController::class, 'index'])->name('blog');
    Route::get('/blog/{slug}', [Controllers\BlogController::class, 'details'])->name('blog.details');
    Route::get('/representantes', [Controllers\RepresentativesController::class, 'index'])->name('representatives');
    Route::get('/contato', [Controllers\ContactController::class, 'index'])->name('contact');
    Route::get('/politica-de-privacidade', [Controllers\PrivacyController::class, 'index'])->name('privacy');
});

// Rotas da restrita que ficam sem o middleware de autorização
Route::match(['get', 'post'], '/restrita/password/send-recovery', [Controllers\Restrita\PasswordRecoveryController::class, 'sendRecovery'])
    ->name('platform.password.send-recovery');

Route::match(['get', 'post'], '/restrita/password/recover-password/{id}', [Controllers\Restrita\PasswordRecoveryController::class, 'recoverPassword'])
    ->name('platform.password.recover-password');
