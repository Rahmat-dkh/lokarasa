<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('vendor.orders.index') }}" class="text-gray-600 hover:text-gray-900">&larr; Back to
                    Orders</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Order Details -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">Items</h3>
                        <ul class="divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <li class="py-4 flex justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16">
                                            @if($item->product->image)
                                                <img class="h-16 w-16 rounded object-cover"
                                                    src="{{ asset('storage/' . $item->product->image) }}" alt="">
                                            @else
                                                <div class="h-16 w-16 rounded bg-gray-200"></div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                            <div class="text-sm text-gray-500">Qty: {{ $item->quantity }}</div>
                                        </div>
                                    </div>
                                    <div class="text-sm font-bold text-gray-900">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4 border-t pt-4 flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">Shipping Info</h3>
                        <p><strong>Recipient:</strong> {{ $order->user->name }}</p>
                        <p><strong>Address:</strong> {{ $order->shipping_address }} (Assume string for now)</p>
                        <!-- Note: shipping_address in DB is string. In Checkout we saved full string. -->
                    </div>
                </div>

                <!-- Action Panel -->
                <div class="space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">Actions</h3>
                        <form action="{{ route('vendor.orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Update Status</label>
                                <select name="status"
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                        Processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Courier / Tracking</label>
                                <input type="text" name="shipping_courier" placeholder="JNE/J&T"
                                    class="block w-full border-gray-300 rounded-md shadow-sm mb-2"
                                    value="{{ $order->shipping_courier }}">
                            </div>

                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Update Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>