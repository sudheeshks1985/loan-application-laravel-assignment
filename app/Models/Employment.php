<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['employer_name', 'employer_address','annual_income'];

    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }

}
