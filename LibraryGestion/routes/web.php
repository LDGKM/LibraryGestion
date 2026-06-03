<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LibraryGestionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\NotificationController;
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


/*Route::get('/',function(){
    return view('welcome');
});*/






//--AUTH--
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource("book",BookController::class)->except('index,show');
    Route::get('book/borrow/{id}',[BookController::class,'borrow'])->name('book.borrow'); 

    //--LOAN--
    Route::controller(LoanController::class)->group(function(){
        Route::get("borrow","index")->name('borrow.index');
        Route::post('borrow/pendingStore','pendingStore')->name('borrow.pendingStore');
        Route::get('borrow/show','show')->name('borrow.show');
        Route::delete('borrow/destroy/{id}','destroy')->name('borrow.destroy');
        Route::get('borrow/loanHistory','loanHistory')->name('borrow.loanHistory');
        Route::put('borrow/{id}/statusUpdate','statusUpdate')->name('borrow.statusUpdate');
    });


    //--USERS--
    Route::controller(UserController::class)->group(function(){
        Route::get('users','index')->name('users.index');
        Route::put('users/{id}/userUpdate','userUpdate')->name('users.userUpdate');
    });

    //--BALANCE--
    Route::controller(BalanceController::class)->group(function(){
        Route::get('balance/{id}','index')->name('balance.index');
    });

    //--NOTIFICATIONS--
    Route::controller(NotificationController::class)->group(function(){
        Route::get('notifications','index')->name('notifications.index');

    });    
});

require __DIR__.'/auth.php';


Route::controller(LibraryGestionController::class)->group(function(){
    Route::get('/','index')->name('lib.index');
});


//--BOOK--
Route::controller(BookController::class)->group(function (){
    Route::post('book/search','search')->name('book.search');
    
});

Route::resource("book",BookController::class)->only('index','show');



//--AUTHOR--
Route::get("author/create-missing",[AuthorController::class,'createMissing'])->name('author.create-missing');

Route::post("author/store-missing",[BookController::class,"storeMissing"])->name("author.store-missing");

