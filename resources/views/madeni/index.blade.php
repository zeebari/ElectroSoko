@extends('layout')
@section('kichwa', 'الديون')

@section('maudhui')
<div class="space-y-4">

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white rounded-2xl border border-orange-200 shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center shrink-0">
                <span class="text-xl font-bold text-orange-600">IQD</span>
            </div>
            <div>
                <p class="text-sm text-slate-500">إجمالي الديون (IQD)</p>
                <p class="text-2xl font-bold text-orange-700">{{ format_sarafu($jumla_iqd, 'IQD') }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-green-200 shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                <span class="text-xl font-bold text-green-600">$</span>
            </div>
            <div>
                <p class="text-sm text-slate-500">إجمالي الديون (USD)</p>
                <p class="text-2xl font-bold text-green-700">{{ format_sarafu($jumla_usd, 'USD') }}</p>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">النوع</label>
                <select name="aina" class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">الكل</option>
                    <option value="deni"   {{ request('aina') === 'deni'  ? 'selected' : '' }}>دين</option>
                    <option value="awamu" {{ request('aina') === 'awamu' ? 'selected' : '' }}>أقساط</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">العملة</label>
                <select name="sarafu" class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">الكل</option>
                    <option value="IQD" {{ request('sarafu') === 'IQD' ? 'selected' : '' }}>IQD</option>
                    <option value="USD" {{ request('sarafu') === 'USD' ? 'selected' : '' }}>USD</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">بحث</label>
                <input type="text" name="tafuta" value="{{ request('tafuta') }}"
                       placeholder="الاسم / الرقم..."
                       class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-44">
            </div>
            <button type="submit" class="px-4 py-2 bg-slate-700 text-white rounded-lg text-sm hover:bg-slate-800 font-medium">تصفية</button>
            @if(request()->anyFilled(['aina','sarafu','tafuta']))
                <a href="{{ route('madeni.index') }}" class="px-4 py-2 border border-slate-300 text-slate-600 rounded-lg text-sm hover:bg-slate-50">مسح</a>
            @endif
        </form>
    </div>

    {{-- Debts Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">الديون المستحقة
                <span class="text-slate-400 font-normal text-sm mr-2">({{ $madeni->total() }})</span>
            </h2>
        </div>
        @if($madeni->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-slate-500 font-medium">لا توجد ديون مستحقة!</p>
                <p class="text-slate-400 text-sm mt-1">جميع المبيعات مكتملة.</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase">الرقم</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase">العميل</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase">النوع</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase">العملة</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">الإجمالي</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">الرصيد</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase">التاريخ</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($madeni as $u)
                    <tr class="hover:bg-orange-50">
                        <td class="px-5 py-3">
                            <a href="{{ route('mauzo.show', $u) }}" class="text-blue-600 hover:text-blue-700 font-mono font-medium text-xs">
                                {{ $u->nambari }}
                            </a>
                        </td>
                        <td class="px-5 py-3">
                            @if($u->mteja)
                                <a href="{{ route('wateja.show', $u->mteja) }}" class="font-medium text-slate-800 hover:text-blue-700">
                                    {{ $u->mteja->jina }}
                                </a>
                                @if($u->mteja->simu)
                                    <p class="text-xs text-slate-400">{{ $u->mteja->simu }}</p>
                                @endif
                            @else
                                <span class="text-slate-400">زبون عابر</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-center">
                            @if($u->aina_malipo === 'deni')
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">دين</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">أقساط</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-center">
                            <span class="font-bold text-xs {{ $u->sarafu === 'USD' ? 'text-green-700' : 'text-blue-700' }}">{{ $u->sarafu }}</span>
                        </td>
                        <td class="px-5 py-3 text-right text-slate-700">{{ format_sarafu($u->jumla, $u->sarafu) }}</td>
                        <td class="px-5 py-3 text-right font-bold text-red-600 text-base">{{ format_sarafu($u->salio, $u->sarafu) }}</td>
                        <td class="px-5 py-3 text-slate-500 text-xs">{{ $u->tarehe->format('d/m/Y') }}</td>
                        <td class="px-5 py-3 text-center">
                            <a href="{{ route('mauzo.show', $u) }}"
                               class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-100">
                                Malipo
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100">{{ $madeni->links() }}</div>
        @endif
    </div>

</div>
@endsection
