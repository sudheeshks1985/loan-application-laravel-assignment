<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanApplication extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['loan_application_number', 'loan_amount'];

    public function borrowers()
    {
        return $this->hasMany(Borrower::class);
    }
    public function employment()
    {
        return $this->hasManyThrough(Employment::class,Borrower::class);
    }
    public function bankAccount()
    {
        return $this->hasManyThrough(BankAccount::class,Borrower::class);
    }

}
