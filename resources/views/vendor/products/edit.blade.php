<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Edit Produk') }}
            </h2>
            <a href="{{ route('vendor.products.index') }}"
                class="text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-slate-100">
                <div class="p-6 sm:p-10">
                    <form method="POST" action="{{ route('vendor.products.update', $product) }}"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Product Image Upload -->
                        <div class="flex flex-col items-center justify-center mb-8">
                            <label for="image" class="relative group cursor-pointer">
                                <div
                                    class="w-32 h-32 sm:w-40 sm:h-40 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden hover:border-primary transition-colors">
                                    @if($product->image)
                                        <img id="previewHelper" src="{{ asset('storage/' . $product->image) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div id="placeholderIcon" class="text-center p-4">
                                            <svg class="w-8 h-8 text-slate-400 mx-auto mb-2 group-hover:text-primary transition-colors"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            <p
                                                class="text-[10px] text-slate-500 font-bold uppercase tracking-widest group-hover:text-primary">
                                                Ganti Foto</p>
                                        </div>
                                        <img id="previewHelper" class="hidden w-full h-full object-cover">
                                    @endif

                                    <!-- Overlay for existing image -->
                                    <div
                                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
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
                                type="text" name="name" :value="old('name', $product->name)" required autofocus />
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
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                        </option>
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
                                    type="number" name="stock" :value="old('stock', $product->stock)" required />
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
                                    type="number" name="price" :value="old('price', $product->price)" required />
                            </div>
                            <x-input-error :messages="$errors->get('price')" class="mt-1" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" value="Deskripsi Produk"
                                class="text-[10px] uppercase tracking-widest mb-1.5" />
                            <textarea id="description" name="description"
                                class="block w-full px-4 py-3 text-sm rounded-xl bg-slate-50 border-transparent focus:bg-white focus:border-primary focus:ring-primary transition-all shadow-sm"
                                rows="4">{{ old('description', $product->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full py-4 bg-primary text-white font-black rounded-xl shadow-lg shadow-primary/30 hover:bg-primary-dark transition-all active:scale-95 text-sm uppercase tracking-widest">
                                Perbarui Produk &rarr;
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
                    var preview = document.getElementById('previewHelper');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');

                    // Hide placeholder if exists
                    var placeholder = document.getElementById('placeholderIcon');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>