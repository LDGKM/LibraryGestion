<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Notifications\BookReturnedNotification;
use Carbon\Carbon;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book=session('book');
        return view('librarygestion.loan.index',compact('book'));
    }

    public function pendingStore(StoreLoanRequest $request)
    {
        $request->validated();
        $loan=Loan::create(
            [
                "book_id"=>$request->book_id,
                "user_id"=>$request->user_id,
                "status"=>'PENDING',
            ]);

        
        return redirect()->route('borrow.show')->with('message', 'Demande d\'emprunt en attente de validation');
    }

    public function show()
    {
        $query=Loan::where('user_id',auth()->id())->orderBy('created_at', 'desc');
        $loans=$query->get();
        return view('librarygestion.loan.show',compact('loans'));
    }


    public function loanHistory(){
        $query=Loan::with('book');
        $query->with('user');
        
        $loans=$query->get();
        return view('librarygestion.loan.loanHistory',compact('loans'));
    }
    

    public function destroy($id)
    {
        Loan::destroy($id);
        return redirect()->route('borrow.show');
    }

    public function statusUpdate(Request $request,$id)
    {
        if($request->has('RETURNED')) 
        {
            $this->returned($id);
        }
        else if($request->has('LOST')) 
        {
            $this->lost($id);   
        }

        return redirect()->route('borrow.loanHistory');
    }

    private function returned($id)
    {
        $loan=Loan::with(['user','book'])->findOrFail($id);
        $loan->status='RETURNED';
        $loan->book->nb_exemp_dispo+=1;
        $loan->user->nb_pret-=1;
        $loan->penality_amount=0.00;
        $loan->returned_at=Carbon::now();

        $loan->user->notify(new BookReturnedNotification($loan));
        $loan->save();
        $loan->book->save();
        $loan->user->save();
    }

    private function lost($id)
    {
        $loan=Loan::findOrFail($id);
        $loan->status='LOST';
        $loan->book->nb_exemp_total-=1;
        $loan->penality_amount=$loan->book->price;
        $loan->user->status='suspended';
        $loan->user->balance-=$loan->book->price;
        $loan->save();
        $loan->book->save();
        $loan->user->save();
    }

}
