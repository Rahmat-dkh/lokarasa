<x-app-layout>
    <div class="py-6 sm:py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2 sm:mb-4">
                        <a href="{{ route('vendor.dashboard') }}"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white shadow-sm border border-slate-100 text-slate-400 hover:text-primary transition-colors lg:hidden">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        <div class="text-primary font-black uppercase tracking-[0.3em] text-[10px]">Keuangan Toko</div>
                    </div>
                    <h1 class="text-xl sm:text-3xl font-black text-slate-900 tracking-tighter">
                        Dompet <span class="text-primary italic">Saya</span>.
                    </h1>
                </div>
                <a href="{{ route('vendor.dashboard') }}"
                    class="hidden lg:inline-flex text-[10px] sm:text-xs font-black text-slate-400 hover:text-primary transition-colors uppercase tracking-widest">
                    &larr; Kembali Dashboard
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Balance Card -->
                <div class="lg:col-span-1 space-y-4">
                    <div
                        class="bg-primary rounded-3xl p-5 sm:p-6 text-white shadow-xl shadow-primary/10 relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="text-[8px] sm:text-[9px] font-black uppercase tracking-widest opacity-80 mb-1">Total Saldo
                            </h3>
                            <div class="text-xl sm:text-2xl font-black italic mb-5 sm:mb-6">
                                Rp {{ number_format($wallet->balance ?? 0, 0, ',', '.') }}
                            </div>

                            <form action="{{ route('vendor.wallet.store') }}" method="POST" class="space-y-3">
                                @csrf
                                <div class="space-y-1.5">
                                    <label
                                        class="block text-[8px] sm:text-[9px] font-black uppercase tracking-widest opacity-80">Jumlah
                                        Tarik</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-white font-bold text-xs">Rp</span>
                                        </div>
                                        <input type="number" name="amount" min="10000" step="1"
                                            class="w-full pl-9 pr-3 py-2 bg-white/20 border-white/10 rounded-xl text-white text-xs font-bold focus:bg-white/30 focus:ring-0 focus:border-white/50 transition-all placeholder-white/30"
                                            placeholder="Minimal 10.000">
                                    </div>
                                </div>
                                <button type="submit"
                                    class="w-full bg-white text-primary font-black text-[9px] uppercase tracking-widest py-2.5 sm:py-3 rounded-xl hover:bg-slate-50 transition-all shadow-lg active:scale-95">
                                    Konfirmasi Tarik Dana
                                </button>
                            </form>
                        </div>
                        <!-- Decoration -->
                        <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-white/10 rounded-full blur-2xl"></div>
                        <div class="absolute -left-3 -top-3 w-16 h-16 bg-black/5 rounded-full blur-xl"></div>
                    </div>

                    <!-- Bank Info Helper -->
                    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-100 shadow-sm">
                        <h4 class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2.5 border-b border-slate-50 pb-1.5">Rekening Tujuan</h4>
                        @if(auth()->user()->vendor->bank_name)
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div
                                        class="text-[10px] font-black text-slate-800 uppercase tracking-tight truncate">
                                        {{ auth()->user()->vendor->bank_name }}</div>
                                    <div class="text-[9px] font-bold text-slate-400">
                                        {{ auth()->user()->vendor->bank_account_number }}</div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-1">
                                <p class="text-[9px] font-bold text-amber-500">Rekening belum diatur</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- History Sections -->
                <div class="lg:col-span-2 space-y-6 sm:space-y-8">
                    <!-- Payout Requests -->
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="px-5 sm:px-8 py-4 sm:py-5 border-b border-slate-50 flex items-center justify-between">
                            <h3 class="text-xs sm:text-sm font-black text-slate-800 uppercase tracking-widest">Riwayat Penarikan
                            </h3>
                            <span class="text-[10px] font-bold text-slate-400">{{ $payouts->count() }} Permintaan</span>
                        </div>

                        @if($payouts->isEmpty())
                            <div class="py-10 text-center">
                                <p class="text-slate-400 font-bold italic text-sm">Belum ada riwayat penarikan.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <tbody class="divide-y divide-slate-50">
                                        @foreach($payouts as $payout)
                                                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                                                        <td class="px-5 sm:px-8 py-3.5 sm:py-4">
                                                                            <div class="text-xs sm:text-sm font-black text-slate-800 italic">Rp
                                                                                {{ number_format($payout->amount, 0, ',', '.') }}</div>
                                                                            <div
                                                                                class="text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                                                {{ $payout->created_at->format('d M Y, H:i') }}</div>
                                                                        </td>
                                                                        <td class="px-5 sm:px-8 py-3.5 sm:py-4 text-right">
                                                                            <span
                                                                                class="px-2 py-0.5 sm:px-3 sm:py-1 rounded-lg text-[8px] sm:text-[9px] font-black uppercase tracking-widest 
                                                                                        {{ $payout->status == 'completed' ? 'bg-emerald-50 text-emerald-500' :
                                            ($payout->status == 'pending' ? 'bg-amber-50 text-amber-500' : 'bg-red-50 text-red-500') }}">
                                                                                {{ $payout->status == 'pending' ? 'Diproses' : ($payout->status == 'completed' ? 'Selesai' : 'Gagal') }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <!-- Transactions -->
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="px-5 sm:px-8 py-4 sm:py-5 border-b border-slate-50 flex items-center justify-between">
                            <h3 class="text-xs sm:text-sm font-black text-slate-800 uppercase tracking-widest">Riwayat Transaksi
                            </h3>
                            <span class="text-[10px] font-bold text-slate-400">{{ $transactions->count() }}
                                Aktivitas</span>
                        </div>

                        @if($transactions->isEmpty())
                            <div class="py-10 text-center">
                                <p class="text-slate-400 font-bold italic text-sm">Belum ada aktivitas.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <tbody class="divide-y divide-slate-50">
                                        @foreach($transactions as $trx)
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="px-5 sm:px-8 py-3.5 sm:py-4">
                                                    <div class="text-xs sm:font-bold text-slate-800 font-bold">{{ $trx->description }}</div>
                                                    <div
                                                        class="text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                        {{ $trx->created_at->format('d M Y, H:i') }}</div>
                                                </td>
                                                <td class="px-5 sm:px-8 py-3.5 sm:py-4 text-right">
                                                    <div
                                                        class="text-xs sm:text-sm font-black italic {{ $trx->type == 'credit' ? 'text-emerald-500' : 'text-red-500' }}">
                                                        {{ $trx->type == 'credit' ? '+' : '-' }} Rp
                                                        {{ number_format(abs($trx->amount), 0, ',', '.') }}
                                                    </div>
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
    </div>
</x-app-layout>