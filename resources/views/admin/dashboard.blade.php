<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-black text-neutral-dark tracking-tight">Dashboard Overview</h1>
        <p class="text-slate-500 font-medium">Welcome back, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Visitors -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-black text-slate-400 uppercase">Visits</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['total_visits']) }}</h3>
            <p class="text-xs text-slate-500 font-bold mt-1">Total Web Visits</p>
        </div>

        <!-- Messages -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-black text-slate-400 uppercase">Messages</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['total_messages']) }}</h3>
            <p class="text-xs text-slate-500 font-bold mt-1">
                @if($stats['unread_messages'] > 0)
                    <span class="text-red-500">{{ $stats['unread_messages'] }} Unread</span>
                @else
                    All Caught Up
                @endif
            </p>
        </div>

        <!-- Products -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <span class="text-xs font-black text-slate-400 uppercase">Products</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['total_products']) }}</h3>
            <p class="text-xs text-slate-500 font-bold mt-1">Active Items</p>
        </div>

        <!-- Orders -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="text-xs font-black text-slate-400 uppercase">Orders</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['total_orders']) }}</h3>
            <p class="text-xs text-slate-500 font-bold mt-1">Total Transactions</p>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Orders -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-black text-slate-800">Recent Orders</h3>
                <a href="#" class="text-sm font-bold text-primary hover:text-primary-dark">View All</a>
            </div>

            @if($stats['recent_orders']->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b border-slate-100">
                                <th class="pb-4 text-xs font-black text-slate-400 uppercase">ID</th>
                                <th class="pb-4 text-xs font-black text-slate-400 uppercase">Customer</th>
                                <th class="pb-4 text-xs font-black text-slate-400 uppercase">Status</th>
                                <th class="pb-4 text-xs font-black text-slate-400 uppercase text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($stats['recent_orders'] as $order)
                                <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50">
                                    <td class="py-4 font-bold text-slate-800">#{{ $order->id }}</td>
                                    <td class="py-4 text-slate-600">{{ $order->user->name }}</td>
                                    <td class="py-4">
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-600 rounded-lg text-xs font-black uppercase">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 font-bold text-slate-800 text-right">Rp
                                        {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-10">
                    <p class="text-slate-400 font-medium">No recent orders found.</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            <h3 class="text-xl font-black text-slate-800 mb-6">Quick Actions</h3>
            <div class="space-y-4">
                <a href="{{ route('admin.products.create') }}"
                    class="block w-full text-center py-3 bg-slate-50 border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-100 transition-colors">
                    + Add New Product
                </a>
                <a href="{{ route('admin.categories.create') }}"
                    class="block w-full text-center py-3 bg-slate-50 border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-100 transition-colors">
                    + Add Category
                </a>
                <a href="{{ route('admin.contacts.index') }}"
                    class="block w-full text-center py-3 bg-slate-50 border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-100 transition-colors">
                    Check Messages
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>