<?php
use Illuminate\Support\Facades\Route;

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
Route::get('/carr', [\App\Http\Controllers\CarController::class, 'index']);

Route::get('/car/{car}', [\App\Http\Controllers\CarController::class, 'show']);
Route::get('/car/create/post', [\App\Http\Controllers\CarController::class, 'create']); //shows create post form
Route::post('/car/create/post', [\App\Http\Controllers\CarController::class, 'store']); //saves the created post to the databse
Route::get('/car/{car}/edit', [\App\Http\Controllers\CarController::class, 'edit']); //shows edit post form
Route::put('/car/{car}/edit', [\App\Http\Controllers\CarController::class, 'update']); //commits edited post to the database 
Route::delete('/car/{car}', [\App\Http\Controllers\CarController::class, 'destroy']); //deletes post from the database