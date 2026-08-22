<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m0-6h3a1 1 0 011 1v4a1 1 0 01-1 1h-3m0-6v6"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-900">
                    Wallet
                </h2>
                <p class="text-sm text-slate-500">
                    Manage your earnings, rewards and transactions
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR MESSAGE --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- BALANCE --}}
        <div class="bg-blue-700 text-white rounded-xl shadow-lg p-8">
            <p class="text-sm font-medium uppercase tracking-wide text-gray-300">
                Available Balance
            </p>
            <p class="text-4xl font-bold mt-2">
                ৳ {{ number_format($wallet->balance, 2) }}
            </p>
            <p class="text-sm text-gray-300 mt-2">
                Your current wallet balance
            </p>
        </div>

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Total Earnings --}}
            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm font-medium text-gray-600">Total Earnings</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">
                    ৳ {{ number_format($totalEarnings, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-2">Money earned from completed work</p>
            </div>

            {{-- Total Deposits --}}
            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm font-medium text-gray-600">Total Deposits</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">
                    ৳ {{ number_format($totalDeposits, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-2">Money added to your wallet</p>
            </div>

            {{-- Total Payments --}}
            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm font-medium text-gray-600">Total Payments</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">
                    ৳ {{ number_format($totalPayments, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-2">Money spent on accepted solutions</p>
            </div>
        </div>

        {{-- DEPOSIT FORM --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h2 class="text-xl font-bold text-slate-900">Add Deposit</h2>
            <p class="text-sm text-slate-500 mt-1 mb-5">Add funds to your wallet.</p>

            <form method="POST" action="{{ route('wallet.deposit') }}" class="flex flex-col sm:flex-row gap-4">
                @csrf
                <input
                    type="number"
                    name="amount"
                    min="1"
                    step="0.01"
                    placeholder="Enter amount"
                    required
                    class="flex-1 rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                    Add Deposit
                </button>
            </form>
        </div>

        {{-- TRANSACTION HISTORY & RECEIPT REPORTS --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center flex-wrap gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Transaction History</h2>
                    <p class="text-sm text-slate-500 mt-1">Your recent wallet activity and receipts</p>
                </div>
                
                {{-- Direct Link to Full Report Page --}}
                <a href="{{ route('receipts.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold uppercase tracking-wider rounded-xl shadow-sm transition">
                    Full Reports & Receipts &rarr;
                </a>
            </div>

            @if($transactions->count())
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Date</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Type</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Description</th>
                                <th class="text-right px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Amount</th>
                                <th class="text-right px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Balance</th>
                                <th class="text-right px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach($transactions as $transaction)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $transaction->created_at->format('d M Y, h:i A') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($transaction->type === 'deposit')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Deposit</span>
                                        @elseif($transaction->type === 'earning')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Earning</span>
                                        @elseif($transaction->type === 'payment')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Payment</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">Reward</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        {{ $transaction->description }}
                                    </td>

                                    <td class="px-6 py-4 text-right font-semibold">
                                        @if($transaction->type === 'payment')
                                            <span class="text-red-600">- ৳ {{ number_format($transaction->amount, 2) }}</span>
                                        @else
                                            <span class="text-green-600">+ ৳ {{ number_format($transaction->amount, 2) }}</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-right font-semibold text-slate-900">
                                        ৳ {{ number_format($transaction->balance_after, 2) }}
                                    </td>

                                    {{-- Receipt Action Button --}}
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('receipts.show', $transaction->id) }}" 
                                           class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-semibold rounded-lg transition border border-blue-200">
                                            Receipt
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-6">
                    {{ $transactions->links() }}
                </div>
            @else
                <div class="p-10 text-center">
                    <p class="text-slate-500">No transactions yet.</p>
                </div>
            @endif
        </div>

    </div>

</x-app-layout>
