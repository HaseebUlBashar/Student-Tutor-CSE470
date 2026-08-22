<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class TransactionReceiptController extends Controller
{
    /**
     * Display the transaction summary report.
     */
    public function index()
    {
        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet) {
            $transactions = collect();
        } else {
            $transactions = WalletTransaction::where('wallet_id', $wallet->id)
                ->latest()
                ->paginate(10);
        }

        return view('receipts.index', compact('transactions', 'wallet'));
    }

    /**
     * Display the printable/downloadable receipt.
     */
    public function show($id)
    {
        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet) {
            abort(404, 'Wallet not found.');
        }

        $transaction = WalletTransaction::where('id', $id)
            ->where('wallet_id', $wallet->id)
            ->firstOrFail();

        return view('receipts.show', compact('transaction', 'user'));
    }
}