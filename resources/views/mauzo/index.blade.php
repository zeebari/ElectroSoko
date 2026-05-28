@extends('layout')
@section('kichwa', t('nav_sales'))

@section('maudhui')
<div class="space-y-4">

    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">{{ t('payment_type') }}</label>
                <select name="aina" class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">{{ t('all') }}</option>
                    <option value="taslimu" {{ request('aina') === 'taslimu' ? 'selected' : '' }}>{{ t('cash') }}</option>
                    <option value="deni"    {{ request('aina') === 'deni'    ? 'selected' : '' }}>{{ t('debt') }}</option>
                    <option value="awamu"  {{ request('aina') === 'awamu'   ? 'selected' : '' }}>{{ t('installments') }}</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">{{ t('currency') }}</label>
                <select name="sarafu" class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">{{ t('all') }}</option>
                    <option value="IQD" {{ request('sarafu') === 'IQD' ? 'selected' : '' }}>IQD - دينار</option>
                    <option value="USD" {{ request('sarafu') === 'USD' ? 'selected' : '' }}>USD - دولار</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">{{ t('status') }}</label>
                <select name="hali" class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">{{ t('all') }}</option>
                    <option value="wazi"       {{ request('hali') === 'wazi'       ? 'selected' : '' }}>{{ t('open') }}</option>
                    <option value="kumalizika" {{ request('hali') === 'kumalizika' ? 'selected' : '' }}>{{ t('completed') }}</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">بحث</label>
                <input type="text" name="tafuta" value="{{ request('tafuta') }}"
                       placeholder="{{ t('number') }} / {{ t('name') }}..."
                       class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-44">
            </div>
            <button type="submit" class="px-4 py-2 bg-slate-700 text-white rounded-lg text-sm hover:bg-slate-800 font-medium">{{ t('filter') }}</button>
            @if(request()->anyFilled(['aina','sarafu','hali','tafuta']))
                <a href="{{ route('mauzo.index') }}" class="px-4 py-2 border border-slate-300 text-slate-600 rounded-lg text-sm hover:bg-slate-50">إلغاء</a>
            @endif
        </form>
    </div>

    <div class="flex justify-between items-center">
        <p class="text-sm text-slate-500">{{ $mauzo->total() }} مبيعات</p>
        <a href="{{ route('mauzo.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            بيع جديد
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if($mauzo->isEmpty())
            <div class="px-6 py-16 text-center">
                <p class="text-slate-400 mb-3">{{ t('no_sales') }}</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">رقم الفاتورة</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">{{ t('customer') }}</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">{{ t('type') }}</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase">{{ t('currency') }}</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">{{ t('total') }}</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">{{ t('paid') }}</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">{{ t('balance') }}</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase">{{ t('status') }}</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">{{ t('date') }}</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase">{{ t('actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($mauzo as $u)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3">
                            <a href="{{ route('mauzo.show', $u) }}" class="text-blue-600 hover:text-blue-700 font-mono font-medium text-xs">
                                {{ $u->nambari }}
                            </a>
                        </td>
                        <td class="px-5 py-3 text-slate-700">{{ $u->mteja?->jina ?? '—' }}</td>
                        <td class="px-5 py-3">
                            @if($u->aina_malipo === 'taslimu')
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ t('cash') }}</span>
                            @elseif($u->aina_malipo === 'deni')
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">{{ t('debt') }}</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">{{ t('installments') }}</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-center">
                            <span class="font-bold text-xs {{ $u->sarafu === 'USD' ? 'text-green-700' : 'text-blue-700' }}">{{ $u->sarafu }}</span>
                        </td>
                        <td class="px-5 py-3 text-right font-medium text-slate-800">{{ format_sarafu($u->jumla, $u->sarafu) }}</td>
                        <td class="px-5 py-3 text-right text-green-700">{{ format_sarafu($u->ilipwa, $u->sarafu) }}</td>
                        <td class="px-5 py-3 text-right {{ $u->salio > 0 ? 'text-red-600 font-medium' : 'text-green-600' }}">
                            {{ $u->salio > 0 ? format_sarafu($u->salio, $u->sarafu) : '✓' }}
                        </td>
                        <td class="px-5 py-3 text-center">
                            @if($u->hali === 'kumalizika')
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ t('completed') }}</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">{{ t('open') }}</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-slate-500 text-xs">{{ $u->tarehe->format('d/m/Y') }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('mauzo.show', $u) }}"
                                   class="px-2.5 py-1 bg-slate-50 text-slate-700 rounded-lg text-xs font-medium hover:bg-slate-100">
                                    عرض
                                </a>
                                <form method="POST" action="{{ route('mauzo.destroy', $u) }}"
                                      onsubmit="return confirm('هل تريد حذف هذه المبيعة؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 bg-red-50 text-red-700 rounded-lg text-xs font-medium hover:bg-red-100">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </td>
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
