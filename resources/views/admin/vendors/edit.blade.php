<x-admin-layout>
    <div class="mb-6 md:mb-8 flex justify-between items-end">
        <div>
            <div class="text-primary font-black uppercase tracking-[0.3em] text-xs mb-4">Manajemen UMKM</div>
            <h1 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter leading-none">
                Edit <span class="text-primary">Toko</span>.
            </h1>
        </div>
        <a href="{{ route('admin.vendors.index') }}"
            class="text-sm font-bold text-slate-400 hover:text-primary transition-colors mb-2">
            &larr; Kembali ke Daftar
        </a>
    </div>

            <div data-aos="fade-up"
                class="glass rounded-[2.5rem] overflow-hidden p-8 sm:p-12 border-white/40 shadow-2xl">
                <form action="{{ route('admin.vendors.update', $vendor) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-8">
                        <!-- Shop Name -->
                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Nama
                                Toko (UMKM)</label>
                            <input type="text" name="shop_name" value="{{ old('shop_name', $vendor->shop_name) }}"
                                class="w-full px-6 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl text-lg font-bold text-slate-900 focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all shadow-inner"
                                required>
                            <x-input-error :messages="$errors->get('shop_name')" class="mt-2" />
                        </div>

                        <!-- Owner / User -->
                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Pemilik
                                (User)</label>
                            <select name="user_id"
                                class="w-full px-6 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl text-lg font-bold text-slate-900 focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all shadow-inner appearance-none">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $vendor->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Status
                                Vendor</label>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach(['active', 'pending', 'suspended'] as $status)
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="status" value="{{ $status }}" class="peer sr-only" {{ old('status', $vendor->status) == $status ? 'checked' : '' }}>
                                        <div
                                            class="px-4 py-4 rounded-2xl border-2 border-slate-100 bg-white text-center transition-all group-hover:border-primary/30 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary">
                                            <span class="text-xs font-black uppercase tracking-widest">{{ $status }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Deskripsi
                                Toko</label>
                            <textarea name="description" rows="4"
                                class="w-full px-6 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl text-base font-medium text-slate-900 focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all shadow-inner">{{ old('description', $vendor->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="pt-8 flex gap-4">
                        <button type="submit"
                            class="flex-grow py-5 bg-primary text-white text-base font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>