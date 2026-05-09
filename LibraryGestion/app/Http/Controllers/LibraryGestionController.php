<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryGestionController extends Controller
{
    public function index(){
        return view('librarygestion.accueil');
    }
}
