<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemTransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Str;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\ReservasiController;

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

Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::get('/jenis/{jenis}', [StoreController::class, 'indexJenis'])->name('store.index.jenis');

Route::middleware(['auth', 'isAdmin'])->group(function () {
  Route::resource('/kategori', KategoriController::class);
  Route::resource('/produk', ProdukController::class);
  Route::resource('user', UserController::class);
  Route::resource('/transaksi', TransaksiController::class);
  Route::resource('/item-transaksi', ItemTransaksiController::class);
  Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');
  Route::get('/reservasi/daftar', [ReservasiController::class, 'listReservasi'])->name('reservasi.daftar');
  Route::post('/changeStatus', [ReservasiController::class, 'changeStatus'])->name('reservasi.changeStatus');
  Route::post('/reservasi/res', [ReservasiController::class, 'changeReservationStatus'])->name('reservasi.res');
});



Route::get('/cloud/{nama}', function ($nama) {
  $minio = Storage::disk('minio');
  $response = Response::make($minio->get('/images' . '/' . $nama), 200);
  $arr = explode('.', Str::lower($nama));
  $file_extension = $arr[count($arr) - 1];
  $ctype = "image/*";
  switch ($file_extension) {
    case "gif":
      $ctype = "image/gif";
      break;
    case "png":
      $ctype = "image/png";
      break;
    case "jpeg":
    case "jpg":
      $ctype = "image/jpeg";
      break;
    case "svg":
      $ctype = "image/svg+xml";
      break;
    default:
  }
  $response->header("Content-Type", $ctype);
  return $response;
})->name('cloud.images');

Auth::routes();

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/cart', [CartController::class, 'addCart'])->name('cart.addCart');
    Route::delete('/cart/{id}', [CartController::class, 'removeCart'])->name('cart.removeCart');
});

Route::get('/user/email-verify/{token}', [VerifyController::class, 'verify']);

Route::view('confirm-email', 'public.confirm_email');
Route::get('checkout', [StoreController::class, 'checkoutSummary'])->name('checkout-summary');
Route::post('checkout', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('checkout');

Route::get('/search/', [StoreController::class, 'search'])->name('store.search');

Route::post('/reservasi', [StoreController::class, 'reservasi'])->name('reservasi.add');

Route::get('/order-history', [StoreController::class, 'order_history'])->name('order-history');

Route::post('/notification/handler', [\App\Http\Controllers\PaymentController::class, 'notification'])->name('notification-handler');

Route::get('/payment/ongoing', [\App\Http\Controllers\PaymentController::class, 'ongoingPayment'])->name('ongoing-payment');

Route::post('/payment/cancel', [\App\Http\Controllers\PaymentController::class, 'cancelPayment'])->name('cancel-payment');
