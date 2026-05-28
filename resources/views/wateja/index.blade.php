@extends('layout')
@section('kichwa', 'Wateja')

@section('maudhui')
<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <form method="GET" class="flex gap-2 flex-1 max-w-sm">
            <input type="text" name="tafuta" value="{{ request('tafuta') }}"
                   placeholder="Tafuta mteja..."
                   class="flex-1 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-slate-700 text-white rounded-lg text-sm hover:bg-slate-800">Tafuta</button>
        </form>
        <a href="{{ route('wateja.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Ongeza Mteja
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Orodha ya Wateja
                <span class="text-slate-400 font-normal text-sm ml-2">({{ $wateja->total() }})</span>
            </h2>
        </div>
        @if($wateja->isEmpty())
            <div class="px-6 py-16 text-center">
                <p class="text-slate-400 mb-3">Bado hakuna wateja.</p>
                <a href="{{ route('wateja.create') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                    Ongeza Mteja
                </a>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Jina</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Simu</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Anwani</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase">Sarafu</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase">Mauzo</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase">Vitendo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($wateja as $i => $m)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3 text-slate-400">{{ $wateja->firstItem() + $i }}</td>
                        <td class="px-6 py-3">
                            <a href="{{ route('wateja.show', $m) }}" class="font-semibold text-blue-700 hover:text-blue-800">
                                {{ $m->jina }}
                            </a>
                        </td>
                        <td class="px-6 py-3 text-slate-600">{{ $m->simu ?? '—' }}</td>
                        <td class="px-6 py-3 text-slate-600">{{ $m->anwani ?? '—' }}</td>
                        <td class="px-6 py-3 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                {{ $m->sarafu_pendwa === 'USD' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $m->sarafu_pendwa }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-center">
                            <span class="text-slate-700 font-medium">{{ $m->mauzo_count }}</span>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('wateja.show', $m) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-slate-50 text-slate-700 rounded-lg text-xs font-medium hover:bg-slate-100">
                                    Ona
                                </a>
                                <a href="{{ route('wateja.edit', $m) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-100">
                                    Hariri
                                </a>
                                <form method="POST" action="{{ route('wateja.destroy', $m) }}"
                                      onsubmit="return confirm('Futa mteja huyu?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-medium hover:bg-red-100">
                                        Futa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100">{{ $wateja->links() }}</div>
        @endif
    </div>

</div>
@endsection
