<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\SensorController;
use App\Http\Controllers\NotifikasiController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('hapus', [SensorController::class, 'hapus']);

// mengirim dan menerima notif dari firebase
Route::get('/fcm', [NotifikasiController::class, 'fcm']);
Route::get('/sendnotif', [NotifikasiController::class, 'sendnotification']);
Route::get('/cobaultra/{id}', [SensorController::class, 'cobaultra']);