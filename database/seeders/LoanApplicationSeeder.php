<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoanApplication;
use App\Models\Borrower;
use App\Models\Employment;
use App\Models\BankAccount;

class LoanApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       LoanApplication::factory()
            ->count(1)
            ->create()
            ->each(function ($loanapplication) {
                $borrower1 = Borrower::factory()->make();
                $loanapplication->borrowers()->save($borrower1)
                ->each(function ($borrower1) {
                    $employment1 = Employment::factory()->make();
                    $borrower1->employment()->save($employment1);

                    $bank_account1 = BankAccount::factory()->make();
                    $borrower1->bankAccounts()->save($bank_account1);
                    
                }); 

                $borrower2 = Borrower::factory()->make();
                $loanapplication->borrowers()->save($borrower2)
                ->each(function ($borrower2) {
                    $employment2 = Employment::factory()->make();
                    $borrower2->employment()->save($employment2);
                }); 
            });
    }
}
