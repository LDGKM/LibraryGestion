<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class LibraryGestionController extends Controller
{
    public function index(){
        $books = Book::with(['categories', 'authors'])->get();
        return view('librarygestion.accueil',compact('books'));
    }
}
