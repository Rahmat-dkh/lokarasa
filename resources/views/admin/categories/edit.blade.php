<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-black text-neutral-dark tracking-tight">Edit Category</h1>
        <p class="text-slate-500 font-medium">Update category details.</p>
    </div>

    <div class="max-w-3xl bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="space-y-2">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Category Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                    class="w-full px-5 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all font-bold text-slate-900">
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full px-5 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all font-bold text-slate-900">{{ old('description', $category->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Image Link
                    (Optional)</label>
                <input type="text" name="image" value="{{ old('image', $category->image) }}"
                    class="w-full px-5 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all font-bold text-slate-900"
                    placeholder="categories/example.jpg">
                <x-input-error :messages="$errors->get('image')" class="mt-1" />
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}"
                    class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition-colors">Cancel</a>
                <button type="submit"
                    class="px-8 py-3 bg-growth text-white font-black rounded-xl hover:bg-growth-dark transition-all shadow-lg shadow-growth/20">Update
                    Category</button>
            </div>
        </form>
    </div>
</x-admin-layout>