<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Payouts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Vendor</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($payouts as $payout)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="font-bold">{{ $payout->vendor->shop_name }}</div>
                                                            <div class="text-sm text-gray-500">{{ $payout->vendor->user->name }}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                            Rp {{ number_format($payout->amount, 0, ',', '.') }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                    {{ $payout->status == 'completed' ? 'bg-green-100 text-green-800' :
                                ($payout->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                                {{ ucfirst($payout->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $payout->created_at->format('d M Y H:i') }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                            @if($payout->status === 'pending')
                                                                <form action="{{ route('admin.payouts.update', $payout) }}" method="POST"
                                                                    class="inline-block">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="status" value="completed">
                                                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Mark
                                                                        Paid</button>
                                                                </form>
                                                                <form action="{{ route('admin.payouts.update', $payout) }}" method="POST"
                                                                    class="inline-block">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="status" value="rejected">
                                                                    <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                                                </form>
                                                            @else
                                                                <span class="text-gray-400">Locked</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>