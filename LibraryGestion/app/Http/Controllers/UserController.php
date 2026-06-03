<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Loan;

class UserController extends Controller
{
    public function index()
    {
        $users=User::all();
        return view('librarygestion.users.index',compact('users'));
    }

    public function userUpdate(Request $request,$id)
    {
        if ($request->has('promote')) {
            $this->promote($id);
        } elseif ($request->has('demote')) {
            $this->demote($id);
        } elseif ($request->has('suspend')) {
            $this->suspend($id);
        } elseif ($request->has('block')) {
            $this->block($id);
        }

        return redirect()->route('users.index');
    }

    private function promote($id)
    {
        $user=User::findOrFail($id);
        $user->role="admin";
        $user->save();
        
    }

    private function demote($id)
    {
        $user=User::findOrFail($id);
        $user->role="user";
        $user->save();
    }

    private function suspend($id)
    {
        $user=User::findOrFail($id);
        $user->status="suspended";
        $user->save();
    }

    private function block($id)
    {
        $user=User::findOrFail($id);
        $user->status="blocked";
        $user->save();
    }
    
        
}
