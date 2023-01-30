<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrower extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name', 'email'];

    public function loanApplication()
    {
        return $this->belongsTo(LoanApplication::class);
    }

    public function employment()
    {
        return $this->hasOne(Employment::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

}
