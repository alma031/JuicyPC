<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('index');
});

Route::get('/cuenta', function () {
    return view('cuenta');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/centro-de-ayuda', function () {
    return view('ayuda');
});

//login
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth','is_admin']], function(){

    Route::get('/cuenta', function(){
        $user = auth()->user();
        return view('cuenta',compact('user'));
    });

    Route::get('/secreta2', function(){
        return "Estas autentificado2";
    });

});

Route::group(['middleware'=>['auth','role:normal']], function(){

    Route::get('/accesonormal', function(){
        echo "Estas autentificado i tienes rol normal";
    });

});

Route::group(['middleware'=>['auth','role:admin']], function(){

    Route::get('/accesoadmin', function(){
        echo "Estas autentificado i tienes rol admin";
    });

});

Route::post('/cuenta/{id}',[UserController::class,'update']);
Route::post('/cuenta/{id}',[UserController::class,'updateBalance']);