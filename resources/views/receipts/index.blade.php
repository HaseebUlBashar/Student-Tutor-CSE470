<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Report & Receipts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Wallet Overview Card -->
            <div class="p-6 bg-white shadow sm:rounded-lg flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Current Balance</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-1">
                        ${{ number_format($wallet->balance ?? 0, 2) }}
                    </p>
                </div>
                <div class="text-sm text-gray-500">
                    User: <span class="font-semibold text-gray-700">{{ auth()->user()->name }}</span>
                </div>
            </div>

            <!-- Transactions Report Table -->
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Transaction History</h3>

                @if($transactions->isEmpty())
                    <p class="text-gray-500 text-center py-6">No transactions found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference / ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Receipt</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($transactions as $tx)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $tx->created_at->format('M d, Y h:i A') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                            #TX-{{ str_pad($tx->id, 6, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                                {{ ($tx->type ?? 'deposit') === 'deposit' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ ucfirst($tx->type ?? 'Transaction') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            ${{ number_format($tx->amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                            <a href="{{ route('receipts.show', $tx->id) }}" class="inline-flex items-center px-3 py-1.5 bg-gray-800 hover:bg-gray-700 text-white text-xs font-medium rounded shadow-sm transition">
                                                Download / Print
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>