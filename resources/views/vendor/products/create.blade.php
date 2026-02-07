<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Tambah Produk Baru') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-slate-100">
                <div class="p-6 sm:p-10">
                    <form method="POST" action="{{ route('vendor.products.store') }}" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <!-- Product Image Upload -->
                        <div class="flex flex-col items-center justify-center mb-8">
                            <label for="image" class="relative group cursor-pointer">
                                <div
                                    class="w-32 h-32 sm:w-40 sm:h-40 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden hover:border-primary transition-colors">
                                    <div class="text-center p-4">
                                        <svg class="w-8 h-8 text-slate-400 mx-auto mb-2 group-hover:text-primary transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        <p
                                            class="text-[10px] text-slate-500 font-bold uppercase tracking-widest group-hover:text-primary">
                                            Upload Foto</p>
                                    </div>
                                    <img id="previewHelper" class="hidden w-full h-full object-cover">
                                </div>
                                <input id="image" type="file" name="image" class="hidden" accept="image/*"
                                    onchange="previewImage(this)">
                            </label>
                            <x-input-error :messages="$errors->get('image')" class="mt-2 text-center" />
                        </div>

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" value="Nama Produk"
                                class="text-[10px] uppercase tracking-widest mb-1.5" />
                            <x-text-input id="name"
                                class="block w-full px-4 py-3 text-sm rounded-xl bg-slate-50 border-transparent focus:bg-white transition-all"
                                type="text" name="name" :value="old('name')" required
                                placeholder="Contoh: Kripik Singkong Balado" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Category -->
                            <div>
                                <x-input-label for="category_id" value="Kategori"
                                    class="text-[10px] uppercase tracking-widest mb-1.5" />
                                <select id="category_id" name="category_id"
                                    class="block w-full px-4 py-3 text-sm rounded-xl bg-slate-50 border-transparent focus:bg-white focus:border-primary focus:ring-primary transition-all shadow-sm">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                            </div>

                            <!-- Stock -->
                            <div>
                                <x-input-label for="stock" value="Stok"
                                    class="text-[10px] uppercase tracking-widest mb-1.5" />
                                <x-text-input id="stock"
                                    class="block w-full px-4 py-3 text-sm rounded-xl bg-slate-50 border-transparent focus:bg-white transition-all"
                                    type="number" name="stock" :value="old('stock')" required placeholder="0" />
                                <x-input-error :messages="$errors->get('stock')" class="mt-1" />
                            </div>
                        </div>

                        <!-- Price -->
                        <div>
                            <x-input-label for="price" value="Harga (Rp)"
                                class="text-[10px] uppercase tracking-widest mb-1.5" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-400 font-bold sm:text-sm">Rp</span>
                                </div>
                                <x-text-input id="price"
                                    class="block w-full pl-12 pr-4 py-3 text-sm rounded-xl bg-slate-50 border-transparent focus:bg-white transition-all font-bold text-lg"
                                    type="number" name="price" :value="old('price')" required placeholder="0" />
                            </div>
                            <x-input-error :messages="$errors->get('price')" class="mt-1" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" value="Deskripsi Produk"
                                class="text-[10px] uppercase tracking-widest mb-1.5" />
                            <textarea id="description" name="description"
                                class="block w-full px-4 py-3 text-sm rounded-xl bg-slate-50 border-transparent focus:bg-white focus:border-primary focus:ring-primary transition-all shadow-sm"
                                rows="4"
                                placeholder="Jelaskan detail produk Anda...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full py-4 bg-primary text-white font-black rounded-xl shadow-lg shadow-primary/30 hover:bg-primary-dark transition-all active:scale-95 text-sm uppercase tracking-widest">
                                Simpan Produk &rarr;
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewHelper').src = e.target.result;
                    document.getElementById('previewHelper').classList.remove('hidden');
                    // Hide the icon/text container if needed, or overlay
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>