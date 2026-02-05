<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-neutral-dark tracking-tight">Messages</h1>
            <p class="text-slate-500 font-medium">Read messages from your website visitors.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        @if($contacts->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">Date
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">From
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                Subject</th>
                            <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                Message</th>
                            <th class="px-6 py-4 text-left text-xs font-black text-slate-400 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($contacts as $contact)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">
                                    {{ $contact->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-slate-800">{{ $contact->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $contact->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-700 font-medium">
                                    {{ $contact->subject ?? 'No Subject' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ Str::limit($contact->message, 50) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($contact->is_read)
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-black rounded-full bg-slate-100 text-slate-500">
                                            Read
                                        </span>
                                    @else
                                        <form action="{{ route('admin.contacts.read', $contact->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-black rounded-full bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors"
                                                title="Mark as Read">
                                                New <span class="ml-1 text-[10px] opacity-70">(Mark Read)</span>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $contacts->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-slate-900">No messages</h3>
                <p class="mt-1 text-sm text-slate-500">You haven't received any messages yet.</p>
            </div>
        @endif
    </div>
</x-admin-layout>