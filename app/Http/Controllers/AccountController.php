<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show($number)
    {
        $account = Account::query()->where('number', $number)->first();
        return view('account', compact('account'));
    }

    public function credit(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|gt:0'
        ]);
        Transaction::query()->create([
            'account_id' => $id,
            'type' => 'credit',
            'amount' => $request->amount,
        ]);

        return back();
    }

    public function debit(Request $request, $id)
    {
        $account = Account::query()->where('id', $id)->first()->BalanceText;

        $request->validate([
            'amount' => 'required|gt:' . $account
        ]);
        Transaction::query()->create([
            'account_id' => $id,
            'type' => 'debit',
            'amount' => $request->amount,
        ]);

        return back();
    }
}
