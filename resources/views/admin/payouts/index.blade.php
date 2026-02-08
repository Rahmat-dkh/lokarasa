<x-admin-layout>
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-black text-neutral-dark tracking-tight">Manajemen Penarikan Dana</h1>
            <p class="text-slate-500 font-medium">Kelola dan verifikasi permintaan penarikan saldo UMKM.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-0">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            UMKM / Toko</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Jumlah</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Informasi Bank</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Tanggal</th>
                        <th
                            class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($payouts as $payout)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-bold text-slate-900">{{ $payout->vendor->shop_name }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $payout->vendor->user->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-primary italic">
                                            Rp {{ number_format($payout->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-[10px] text-slate-600">
                                            <div class="font-black text-slate-900">{{ $payout->vendor->bank_name }}</div>
                                            <div>{{ $payout->vendor->bank_account_number }}</div>
                                            <div class="italic">{{ $payout->vendor->bank_account_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest
                                                                                {{ $payout->status == 'completed' ? 'bg-emerald-50 text-emerald-500' :
                        ($payout->status == 'pending' ? 'bg-amber-50 text-amber-500' : 'bg-red-50 text-red-500') }}">
                                                @php
                                                    $statusTranslations = [
                                                        'pending' => 'Menunggu',
                                                        'completed' => 'Selesai',
                                                        'rejected' => 'Ditolak'
                                                    ];
                                                @endphp
                                                {{ $statusTranslations[$payout->status] ?? $payout->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-500">
                                            {{ $payout->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            @if($payout->status === 'pending')
                                                <form action="{{ route('admin.payouts.update', $payout) }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-600 transition-all shadow-lg active:scale-95 mr-2">Bayar</button>
                                                </form>
                                                <form action="{{ route('admin.payouts.update', $payout) }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-rose-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-rose-600 transition-all shadow-lg active:scale-95">Tolak</button>
                                                </form>
                                            @else
                                                <span
                                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Terkunci</span>
                                            @endif
                                        </td>
                                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>