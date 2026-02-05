<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-neutral-dark tracking-tight">Categories</h1>
            <p class="text-slate-500 font-medium">Manage product categories.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
            class="px-6 py-3 bg-growth text-white font-bold rounded-xl hover:bg-growth-dark transition-all shadow-lg shadow-growth/20">
            + Add New Category
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-2xl font-bold border border-green-100">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                            Category Name</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                            Description</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">Slug
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-black text-slate-400 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-slate-900">{{ $category->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-500 font-medium line-clamp-2">
                                    {{ $category->description ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400 font-mono">
                                {{ $category->slug }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="text-primary hover:text-primary-dark font-bold mr-3">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure? This might affect products.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500 font-medium">
                                No categories found. <a href="{{ route('admin.categories.create') }}"
                                    class="text-primary hover:underline">Add one now</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $categories->links() }}
        </div>
    </div>
</x-admin-layout>