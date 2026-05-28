@extends('layout')
@section('kichwa', 'Mteja: ' . $mteja->jina)

@section('maudhui')
<div class="space-y-5">

    {{-- Customer Card --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-center gap-4 mb-5">
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center shrink-0">
                    <span class="text-2xl font-bold text-blue-600">{{ substr($mteja->jina, 0, 1) }}</span>
                </div>
                <div>
                    <h2 class="font-bold text-slate-800 text-lg">{{ $mteja->jina }}</h2>
                    <p class="text-slate-500 text-sm">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold
                            {{ $mteja->sarafu_pendwa === 'USD' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $mteja->sarafu_pendwa }}
                        </span>
                    </p>
                </div>
            </div>
            <dl class="space-y-3 text-sm">
                @if($mteja->simu)
                <div class="flex justify-between">
                    <dt class="text-slate-500">Simu</dt>
                    <dd class="font-medium text-slate-800">{{ $mteja->simu }}</dd>
                </div>
                @endif
                @if($mteja->anwani)
                <div class="flex justify-between">
                    <dt class="text-slate-500">Anwani</dt>
                    <dd class="font-medium text-slate-800">{{ $mteja->anwani }}</dd>
                </div>
                @endif
                <div class="flex justify-between">
                    <dt class="text-slate-500">Jumla Mauzo</dt>
                    <dd class="font-medium text-slate-800">{{ $mauzo->total() }}</dd>
                </div>
            </dl>
            <div class="mt-5 flex gap-2">
                <a href="{{ route('wateja.edit', $mteja) }}"
                   class="flex-1 text-center px-3 py-2 border border-slate-300 text-slate-700 rounded-lg text-xs font-medium hover:bg-slate-50">
                    Hariri
                </a>
                <a href="{{ route('mauzo.create') }}?mteja_id={{ $mteja->id }}"
                   class="flex-1 text-center px-3 py-2 bg-blue-600 text-white rounded-lg text-xs font-medium hover:bg-blue-700">
                    Uuzaji Mpya
                </a>
            </div>
        </div>

        {{-- Debt Summary --}}
        <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
            @if($madeni_iqd > 0)
            <div class="bg-orange-50 border border-orange-200 rounded-2xl p-5">
                <p class="text-sm font-medium text-orange-700 mb-1">Deni (IQD)</p>
                <p class="text-2xl font-bold text-orange-800">{{ format_sarafu($madeni_iqd, 'IQD') }}</p>
                <a href="{{ route('madeni.index') }}" class="text-xs text-orange-600 mt-1 inline-block hover:underline">Ona madeni →</a>
            </div>
            @endif
            @if($madeni_usd > 0)
            <div class="bg-green-50 border border-green-200 rounded-2xl p-5">
                <p class="text-sm font-medium text-green-700 mb-1">Deni (USD)</p>
                <p class="text-2xl font-bold text-green-800">{{ format_sarafu($madeni_usd, 'USD') }}</p>
            </div>
            @endif
            @if($madeni_iqd == 0 && $madeni_usd == 0)
            <div class="sm:col-span-2 bg-green-50 border border-green-200 rounded-2xl p-5 flex items-center gap-3">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="font-semibold text-green-800">Hakuna Deni</p>
                    <p class="text-sm text-green-600">Mteja huyu hana deni lolote</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Sales History --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800">Historia ya Mauzo</h3>
        </div>
        @if($mauzo->isEmpty())
            <div class="px-6 py-12 text-center">
                <p class="text-slate-400 text-sm">Bado hakuna mauzo kwa mteja huyu.</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Nambari</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Aina</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Sarafu</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">Jumla</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">Salio</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Hali</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Tarehe</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($mauzo as $u)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3">
                            <a href="{{ route('mauzo.show', $u) }}" class="text-blue-600 hover:text-blue-700 font-mono font-medium">
                                {{ $u->nambari }}
                            </a>
                        </td>
                        <td class="px-6 py-3">
                            @if($u->aina_malipo === 'taslimu')
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Taslimu</span>
                            @elseif($u->aina_malipo === 'deni')
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">Deni</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Awamu</span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <span class="font-semibold {{ $u->sarafu === 'USD' ? 'text-green-700' : 'text-blue-700' }}">{{ $u->sarafu }}</span>
                        </td>
                        <td class="px-6 py-3 text-right font-medium text-slate-800">{{ format_sarafu($u->jumla, $u->sarafu) }}</td>
                        <td class="px-6 py-3 text-right {{ $u->salio > 0 ? 'text-red-600 font-medium' : 'text-green-600' }}">
                            {{ $u->salio > 0 ? format_sarafu($u->salio, $u->sarafu) : '✓' }}
                        </td>
                        <td class="px-6 py-3">
                            @if($u->hali === 'kumalizika')
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Kumalizika</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Wazi</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-slate-500">{{ $u->tarehe->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100">{{ $mauzo->links() }}</div>
        @endif
    </div>

</div>
@endsection
