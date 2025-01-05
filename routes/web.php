<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApproveUMKMController;
use App\Http\Controllers\Admin\DataUmkmController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\AllUmkmController;
use App\Http\Controllers\User\OwnerController;
use App\Http\Controllers\User\UMKMController;
use App\Http\Controllers\User\UmkmDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});


Route::redirect('/', '/guest');

Route::get('/guest', function () {
    return view('pages.guest');
})->name('guest');

Route::middleware('auth')->group(function () {


    Route::get('/home/{id}', [HomeController::class, 'index'])->name('home');
    Route::get('/dataUmkm', [DataUmkmController::class, 'index'])->name('dataUmkm');
    Route::get('/dataUser', [DataUserController::class, 'index'])->name('dataUser');
    Route::get('/owner/{id}', [OwnerController::class, 'index'])->name('owner');
    Route::get('/allUmkm', [AllUmkmController::class, 'index'])->name('allUmkm');
    Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/umkmDetail/{id}', [UmkmDetailController::class, 'index'])->name('detail');
    Route::get('/umkmOwnerDetail/{id}', [UmkmDetailController::class, 'index'])->name('detailOwner');

    Route::get('/aboutUs', [AboutUsController::class, 'index'])->name('about');

    Route::get('getUmkm', [HomeController::class, 'getData'])->name('getUmkm');
    Route::get('getUser', [HomeController::class, 'getUser'])->name('getUser');
    Route::get('getCategory', [HomeController::class, 'getCategory'])->name('getCategory');


    Route::get('exportExcel', [AdminController::class, 'exportExcel'])->name('admin.exportExcel');
    Route::get('exportPdf', [AdminController::class, 'exportPdf'])->name('admin.exportPdf');
    Route::get('download-file/{umkmId}', [AdminController::class, 'downloadFile'])->name('admin.downloadFile');
});


Auth::routes();

Route::get('/forgotPassword', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgotPassword', [ForgotPasswordController::class, 'forgotPasswordPost'])->name('forgot.password.post');

Route::get('/resetPassword/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

Route::post('/resetPassword', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');

Route::resource('umkm', UMKMController::class);
Route::resource('admin', AdminController::class);
Route::resource('approveumkm', ApproveUMKMController::class);
Route::delete('/delete', [AdminController::class, 'destroy'])->name('delete');
