<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/',[WelcomeController::class,'index']);

Route::middleware(['auth','verified'])->group(function() {
    Route::resource('products', ProductController::class);

    Route::get('users/list',[UserController::class,'index'])->middleware('auth');
    Route::delete('users/{user}',[UserController::class,'destroy'])->middleware('auth');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

   
});

//Route::get('products',[ProductController::class,'index'])->name('products.index')->middleware('auth');
//Route::get('products/create',[ProductController::class,'create'])->name('products.create')->middleware('auth');
//Route::post('products',[ProductController::class,'store'])->name('products.store')->middleware('auth');
//Route::get('products/{product}',[ProductController::class,'show'])->name('products.show')->middleware('auth');
//
//Route::get('products/edit/{product}',[ProductController::class,'edit'])->name('products.edit')->middleware('auth');
//Route::post('products/{product}',[ProductController::class,'update'])->name('products.update')->middleware('auth');
//Route::delete('products/{product}',[ProductController::class,'destroy'])->name('products.destroy')->middleware('auth');



Auth::routes(['verify' => true]);

