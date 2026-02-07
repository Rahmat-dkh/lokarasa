<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Wallet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('vendor.dashboard') }}" class="text-gray-600 hover:text-gray-900">&larr; Back to Dashboard</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Balance & Withdraw -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-2">Current Balance</h3>
                        <div class="text-3xl font-bold text-indigo-600 mb-6">
                            Rp {{ number_format($wallet->balance ?? 0, 0, ',', '.') }}
                        </div>
                        
                        <form action="{{ route('vendor.wallet.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Withdraw Amount</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="amount" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="0">
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Request Payout
                            </button>
                            <p class="text-xs text-gray-500 mt-2">Minimum withdrawal Rp 10.000</p>
                        </form>
                    </div>
                </div>

                <!-- History -->
                <div class="md:col-span-2 space-y-6">
                     <!-- Payouts -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">Payout Requests</h3>
                        @if($payouts->isEmpty())
                            <p class="text-gray-500">No payout requests.</p>
                        @else
                            <ul class="divide-y divide-gray-200">
                                @foreach($payouts as $payout)
                                    <li class="py-3 flex justify-between items-center">
                                        <div>
                                            <div class="font-bold">Rp {{ number_format($payout->amount, 0, ',', '.') }}</div>
                                            <div class="text-xs text-gray-500">{{ $payout->created_at->format('d M Y H:i') }}</div>
                                        </div>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $payout->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($payout->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($payout->status) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Transactions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">Transaction History</h3>
                        @if($transactions->isEmpty())
                            <p class="text-gray-500">No transactions yet.</p>
                        @else
                            <ul class="divide-y divide-gray-200">
                                @foreach($transactions as $trx)
                                    <li class="py-3 flex justify-between items-center">
                                        <div>
                                            <div class="font-semibold">{{ $trx->description }}</div>
                                            <div class="text-xs text-gray-500">{{ $trx->created_at->format('d M Y H:i') }}</div>
                                        </div>
                                        <div class="font-bold {{ $trx->type == 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $trx->type == 'credit' ? '+' : '-' }} Rp {{ number_format(abs($trx->amount), 0, ',', '.') }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
