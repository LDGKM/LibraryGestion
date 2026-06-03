<?php

namespace App\Services;

use App\Models\Loan;

class LoanPenalityService
{
	public function applyPenality()
	{
		$overdueLoans=Loan::where('status','OVERDUE')
        ->with('book')
        ->with('user')
        ->get();

        if(!empty($overdueLoans))
        {
            foreach($overdueLoans as $over)
            {
                $over->penality_amount-=1.00;
                $over->save();
            }
        }
	}
}