<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incoming Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('vendor.dashboard') }}" class="text-gray-600 hover:text-gray-900">&larr; Back to
                    Dashboard</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($orders->isEmpty())
                        <p class="text-gray-500 text-center">No orders yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Order ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Customer</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($orders as $order)
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap font-bold">#{{ $order->id }}</td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    {{ $order->created_at->format('d M Y H:i') }}</td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                                    {{ $order->user->name }}</td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">Rp
                                                                    {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' :
                                        ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' :
                                            'bg-yellow-100 text-yellow-800') }}">
                                                                        {{ ucfirst($order->status) }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                    <a href="{{ route('vendor.orders.show', $order) }}"
                                                                        class="text-indigo-600 hover:text-indigo-900">View</a>
                                                                </td>
                                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>