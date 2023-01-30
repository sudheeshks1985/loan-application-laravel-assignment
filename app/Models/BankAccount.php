<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['bank_name', 'account_type','balance_amount'];

    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }
}
