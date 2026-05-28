@extends('layout')
@section('kichwa', 'لوحة التحكم')

@section('maudhui')
<div class="space-y-6">

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm font-medium text-slate-500">مبيعات اليوم</p>
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-800">{{ number_format($mauzo_leo) }}</p>
            <p class="text-xs text-slate-400 mt-1">معاملات اليوم</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm font-medium text-slate-500">إيرادات اليوم</p>
                <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ number_format($mapato_leo, 0) }}</p>
            <p class="text-xs text-slate-400 mt-1">إجمالي المدفوع اليوم</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm font-medium text-slate-500">إجمالي الديون</p>
                <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
            <div class="space-y-0.5">
                @if($madeni_iqd > 0)
                    <p class="text-lg font-bold text-orange-600">{{ format_sarafu($madeni_iqd, 'IQD') }}</p>
                @endif
                @if($madeni_usd > 0)
                    <p class="text-lg font-bold text-orange-600">{{ format_sarafu($madeni_usd, 'USD') }}</p>
                @endif
                @if($madeni_iqd == 0 && $madeni_usd == 0)
                    <p class="text-2xl font-bold text-green-600">لا يوجد</p>
                @endif
            </div>
            <p class="text-xs text-slate-400 mt-1">الرصيد المتبقي</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm font-medium text-slate-500">عملاء بديون</p>
                <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-800">{{ number_format($wateja_wenye_deni) }}</p>
            <p class="text-xs text-slate-400 mt-1">المديونون حالياً</p>
        </div>

    </div>

    {{-- Secondary Info --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <a href="{{ route('bidhaa.index') }}"
           class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition-colors">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $jumla_bidhaa }}</p>
                <p class="text-sm text-slate-500">أنواع المنتجات</p>
            </div>
        </a>

        <a href="{{ route('wateja.index') }}"
           class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm flex items-center gap-4 hover:border-blue-300 transition-colors">
            <div class="w-12 h-12 bg-violet-50 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-800">{{ $jumla_wateja }}</p>
                <p class="text-sm text-slate-500">إجمالي العملاء</p>
            </div>
        </a>

        @if($bidhaa_hisa_chini > 0)
        <a href="{{ route('bidhaa.index') }}"
           class="bg-red-50 rounded-2xl p-4 border border-red-200 shadow-sm flex items-center gap-4 hover:border-red-300 transition-colors">
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-red-700">{{ $bidhaa_hisa_chini }}</p>
                <p class="text-sm text-red-600">منتجات مخزون منخفض (&le;5)</p>
            </div>
        </a>
        @else
        <div class="bg-green-50 rounded-2xl p-4 border border-green-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-green-700">المخزون كافٍ</p>
                <p class="text-xs text-green-600">جميع المنتجات متوفرة</p>
            </div>
        </div>
        @endif
    </div>

    {{-- Recent Sales --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">آخر المبيعات</h2>
            <a href="{{ route('mauzo.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">عرض الكل ←</a>
        </div>
        @if($mauzo_hivi_karibuni->isEmpty())
            <div class="px-6 py-12 text-center">
                <p class="text-slate-400 text-sm">لا توجد مبيعات مسجلة بعد.</p>
                <a href="{{ route('mauzo.create') }}"
                   class="mt-3 inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                    ابدأ البيع
                </a>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wide">رقم الفاتورة</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wide">العميل</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wide">النوع</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wide">الإجمالي</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wide">الرصيد</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wide">الحالة</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wide">التاريخ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($mauzo_hivi_karibuni as $uuzaji)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3">
                            <a href="{{ route('mauzo.show', $uuzaji) }}" class="text-blue-600 hover:text-blue-700 font-mono font-medium">
                                {{ $uuzaji->nambari }}
                            </a>
                        </td>
                        <td class="px-6 py-3 text-slate-700">{{ $uuzaji->mteja?->jina ?? '—' }}</td>
                        <td class="px-6 py-3">
                            @if($uuzaji->aina_malipo === 'taslimu')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">نقد</span>
                            @elseif($uuzaji->aina_malipo === 'deni')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">دين</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">أقساط</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 font-medium text-slate-800">{{ format_sarafu($uuzaji->jumla, $uuzaji->sarafu) }}</td>
                        <td class="px-6 py-3 {{ $uuzaji->salio > 0 ? 'text-red-600 font-medium' : 'text-green-600' }}">
                            {{ $uuzaji->salio > 0 ? format_sarafu($uuzaji->salio, $uuzaji->sarafu) : '✓' }}
                        </td>
                        <td class="px-6 py-3">
                            @if($uuzaji->hali === 'kumalizika')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">مكتمل</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">مفتوح</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-slate-500">{{ $uuzaji->tarehe->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>
@endsection
