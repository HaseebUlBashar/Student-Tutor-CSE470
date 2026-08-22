<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #TX-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow border border-gray-200">
        
        <!-- Action Buttons (Hidden when printing/saving PDF) -->
        <div class="no-print flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
            <a href="{{ route('receipts.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                &larr; Back to Transactions
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow">
                Print / Save as PDF
            </button>
        </div>

        <!-- Receipt Header -->
        <div class="flex justify-between items-start pb-6 border-b border-gray-200">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Student-Tutor Platform</h1>
                <p class="text-sm text-gray-500 mt-1">Official Transaction Receipt</p>
            </div>
            <div class="text-right">
                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                    Completed
                </span>
                <p class="text-xs font-mono text-gray-500 mt-2">#TX-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <!-- Billing Info -->
        <div class="grid grid-cols-2 gap-6 py-6 border-b border-gray-200 text-sm">
            <div>
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Billed To</h2>
                <p class="font-bold text-gray-800 mt-1">{{ $user->name }}</p>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
            <div class="text-right">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Transaction Details</h2>
                <p class="text-gray-600 mt-1"><strong class="text-gray-800">Date:</strong> {{ $transaction->created_at->format('M d, Y h:i A') }}</p>
                <p class="text-gray-600"><strong class="text-gray-800">Type:</strong> {{ ucfirst($transaction->type ?? 'Transfer') }}</p>
            </div>
        </div>

        <!-- Receipt Items Table -->
        <div class="py-6 border-b border-gray-200">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase border-b pb-2">
                        <th class="py-2">Description</th>
                        <th class="py-2 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="py-4 text-gray-800">
                            <span class="font-semibold">Wallet {{ ucfirst($transaction->type ?? 'Transaction') }}</span>
                            <p class="text-xs text-gray-500">Completed transfer associated with your account</p>
                        </td>
                        <td class="py-4 text-right font-bold text-gray-900">
                            ${{ number_format($transaction->amount, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Summary Total -->
        <div class="pt-6 flex justify-between items-center">
            <div class="text-xs text-gray-400">
                Generated electronically on {{ now()->format('M d, Y') }}.
            </div>
            <div class="text-right">
                <span class="text-sm text-gray-500 mr-4">Total Paid:</span>
                <span class="text-2xl font-black text-gray-900">${{ number_format($transaction->amount, 2) }}</span>
            </div>
        </div>

    </div>

</body>
</html>