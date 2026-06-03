<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\Notification;
use Carbon\Carbon;
use App\Notifications\BookBorrowedNotification;

class LoanActivationService
{
	public function processPendingLoans()
	{
		$pendingLoans=Loan::where('status','PENDING')
        ->with('book')
        ->with('user')
        ->get();

        foreach ($pendingLoans as $loan) {
            
            if ($loan->book && $loan->user && 
                $loan->book->nb_exemp_dispo >= 1 && 
                $loan->user->nb_pret < 5) {
                
               
                $loan->status = 'ACTIVE';
                $loan->borrowed_at = Carbon::now();
                $loan->due_at = Carbon::now()->addDays(7);
                
                
                $loan->book->nb_exemp_dispo -= 1;
                
                
                $loan->user->nb_pret += 1;
                $loan->user->nb_pret_total += 1;

                $loan->user->notify(new BookBorrowedNotification($loan));

                $loan->save();
                $loan->book->save();
                $loan->user->save();




            }
        }

	}
}