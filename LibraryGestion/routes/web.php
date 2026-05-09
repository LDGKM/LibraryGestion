<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LibraryGestionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

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



Route::controller(LibraryGestionController::class)->group(function(){
    Route::get('/','index')->name('lib.index');
});

//--BOOK--
Route::post('book/search',[BookController::class,'search'])->name('book.search');
Route::resource("book",BookController::class);


//--AUTHOR--


Route::get("author/create-missing",[AuthorController::class,'createMissing'])->name('author.create-missing');

Route::post("author/store-missing",[BookController::class,"storeMissing"])->name("author.store-missing");

Route::resource("author",AuthorController::class);


//--AUTH--
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
