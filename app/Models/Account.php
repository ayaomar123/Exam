<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
        'currency',
        'balance',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getCreditTextAttribute()
    {
        return $this->transactions()->where('type', 'credit')->sum('amount');
    }

    public function getDebitTextAttribute()
    {
        return $this->transactions()->where('type', 'debit')->sum('amount');
    }

    public function getBalanceTextAttribute()
    {
        return $this->CreditText - $this->DebitText;
    }

}
