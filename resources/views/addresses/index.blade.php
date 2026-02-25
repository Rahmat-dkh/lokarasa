<x-app-layout>
    <div class="pt-24 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 px-4 sm:px-0">
                <div>
                    <a href="{{ route('dashboard') }}"
                        class="text-[10px] font-black text-primary uppercase tracking-[0.2em] mb-1 flex items-center gap-1 hover:gap-2 transition-all">
                        ← Kembali ke Dashboard
                    </a>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                        {{ __('Alamat Saya') }}
                    </h2>
                </div>
                <a href="{{ route('addresses.create') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-primary border border-transparent rounded-2xl font-black text-[10px] text-white uppercase tracking-widest hover:bg-primary-dark transition-all shadow-xl shadow-primary/20">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Alamat Baru
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 px-4 sm:px-0">
                @if($addresses->isEmpty())
                    <div class="col-span-full text-center py-16 bg-white rounded-[2rem] border-2 border-dashed border-slate-100 shadow-sm"
                        data-aos="fade-up">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Belum ada alamat tersimpan
                        </p>
                        <a href="{{ route('addresses.create') }}"
                            class="mt-4 inline-block text-primary font-black text-xs uppercase tracking-widest hover:underline">+
                            Tambah Alamat Pertama</a>
                    </div>
                @else
                    @foreach($addresses as $address)
                        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sm:p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 relative group overflow-hidden"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                            <div class="flex justify-between items-start mb-6 relative z-10">
                                <div class="pr-8">
                                    <h3 class="font-black text-slate-900 text-sm sm:text-base leading-tight">
                                        {{ $address->name }}</h3>
                                    <div
                                        class="text-[9px] sm:text-[10px] font-black text-primary uppercase tracking-widest mt-1 bg-primary/5 px-2 py-0.5 rounded-lg inline-block">
                                        {{ $address->phone }}
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-500 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="relative z-10">
                                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mb-8 line-clamp-3">
                                    {{ $address->address_line }},<br>
                                    {{ $address->city }}, {{ $address->province }}<br>
                                    {{ $address->postal_code }}
                                </p>
                            </div>

                            <div class="border-t border-slate-50 pt-5 mt-auto flex justify-end relative z-10">
                                <form action="{{ route('addresses.destroy', $address) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus alamat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-slate-300 hover:text-red-500 text-[10px] font-black flex items-center gap-2 transition-colors uppercase tracking-widest">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus Alamat
                                    </button>
                                </form>
                            </div>

                            <!-- Decorative background shape -->
                            <div
                                class="absolute -right-10 -bottom-10 w-32 h-32 bg-slate-50 rounded-full group-hover:scale-150 transition-transform duration-700 -z-0">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>