<?php

namespace App\Services;

use App\Models\Loan;
use Carbon\Carbon;
use App\Notifications\BookOverdueNotification;
class LoanOverdueService
{
	public function checkOverdueLoans()
	{
		$loans=Loan::where('status','ACTIVE')
        ->with('book')
        ->with('user')
        ->get();

        if(!empty($loans))
        {
            foreach($loans as $loan)
            {
                if(Carbon::now()>$loan->due_at)
                {
                    $loan->status='OVERDUE';
                    $loan->penality_amount=1.00;

                    $loan->user->notify(new BookOverdueNotification($loan));
                    $loan->save();


                }

            }
        }
	}
}