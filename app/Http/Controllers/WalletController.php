<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $wallet = $user->wallet()->firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0]
        );

        $transactions = $wallet->transactions()
            ->latest()
            ->paginate(15);

        $totalEarnings = $wallet->transactions()
            ->where('type', 'earning')
            ->sum('amount');

        $totalRewards = $wallet->transactions()
            ->where('type', 'reward')
            ->sum('amount');

        $totalDeposits = $wallet->transactions()
            ->where('type', 'deposit')
            ->sum('amount');
        $totalPayments = $wallet->transactions()
            ->where('type', 'payment')
            ->sum('amount');

        return view('wallet.index', compact(
            'wallet',
            'transactions',
            'totalEarnings',
            'totalRewards',
            'totalDeposits',
            'totalPayments'
        ));
    }

    public function deposit(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1|max:1000000',
        ]);

        DB::transaction(function () use ($validated) {

            $wallet = Auth::user()
                ->wallet()
                ->firstOrCreate(
                    ['user_id' => Auth::id()],
                    ['balance' => 0]
                );

            $wallet->balance += $validated['amount'];
            $wallet->save();

            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'deposit',
                'amount' => $validated['amount'],
                'description' => 'Wallet deposit',
                'balance_after' => $wallet->balance,
            ]);
        });

        return redirect()
            ->route('wallet.index')
            ->with('success', 'Deposit added successfully.');
    }
}
