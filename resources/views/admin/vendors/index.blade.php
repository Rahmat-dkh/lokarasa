<x-admin-layout>
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-black text-neutral-dark tracking-tight">Manajemen UMKM</h1>
            <p class="text-slate-500 font-medium">Kelola status dan informasi toko UMKM yang terdaftar.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-0">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Nama Toko (UMKM)</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Pemilik</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Bergabung</th>
                        <th
                            class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($vendors as $vendor)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-bold text-slate-900">{{ $vendor->shop_name }}</div>
                                            <div class="text-[10px] text-slate-400 uppercase tracking-tighter">{{ $vendor->slug }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-slate-800">{{ $vendor->user->name }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $vendor->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest
                                                                                {{ $vendor->status == 'active' ? 'bg-emerald-50 text-emerald-500' :
                        ($vendor->status == 'pending' ? 'bg-amber-50 text-amber-500' : 'bg-red-50 text-red-500') }}">
                                                @php
                                                    $statusTranslations = [
                                                        'active' => 'Aktif',
                                                        'pending' => 'Menunggu',
                                                        'suspended' => 'Ditangguhkan'
                                                    ];
                                                @endphp
                                                {{ $statusTranslations[$vendor->status] ?? $vendor->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-500">
                                            {{ $vendor->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <a href="{{ route('admin.vendors.edit', $vendor) }}"
                                                class="inline-flex items-center px-4 py-2 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary transition-all shadow-lg active:scale-95 mr-2">Edit</a>
                                            <form action="{{ route('admin.vendors.update', $vendor) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="shop_name" value="{{ $vendor->shop_name }}">
                                                <input type="hidden" name="user_id" value="{{ $vendor->user_id }}">
                                                @if($vendor->status !== 'active')
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-600 transition-all shadow-lg active:scale-95">Setujui</button>
                                                @else
                                                    <input type="hidden" name="status" value="suspended">
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-rose-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-rose-600 transition-all shadow-lg active:scale-95">Suspend</button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>