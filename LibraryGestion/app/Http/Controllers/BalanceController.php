<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BalanceController extends Controller
{
    public function index($id)
    {
        $user=User::findOrFail($id);
        return view('librarygestion.balance.index',compact('user'));
    }
}
