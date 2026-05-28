@extends('layout')
@section('kichwa', 'العميل: ' . $mteja->jina)

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
                    <dt class="text-slate-500">الهاتف</dt>
                    <dd class="font-medium text-slate-800">{{ $mteja->simu }}</dd>
                </div>
                @endif
                @if($mteja->anwani)
                <div class="flex justify-between">
                    <dt class="text-slate-500">العنوان</dt>
                    <dd class="font-medium text-slate-800">{{ $mteja->anwani }}</dd>
                </div>
                @endif
                <div class="flex justify-between">
                    <dt class="text-slate-500">{{ t('total_sales') }}</dt>
                    <dd class="font-medium text-slate-800">{{ $mauzo->total() }}</dd>
                </div>
            </dl>
            <div class="mt-5 flex gap-2">
                <a href="{{ route('wateja.edit', $mteja) }}"
                   class="flex-1 text-center px-3 py-2 border border-slate-300 text-slate-700 rounded-lg text-xs font-medium hover:bg-slate-50">
                    تعديل
                </a>
                <a href="{{ route('mauzo.create') }}?mteja_id={{ $mteja->id }}"
                   class="flex-1 text-center px-3 py-2 bg-blue-600 text-white rounded-lg text-xs font-medium hover:bg-blue-700">
                    بيع جديد
                </a>
            </div>

            {{-- WhatsApp Button --}}
            @if($mteja->simu)
            @php
                $simu = preg_replace('/[^0-9]/', '', $mteja->simu);
                $msg  = "مرحباً {$mteja->jina} 👋\n";
                $msg .= "كشف حساب من ElectroSoko\n";
                $msg .= "التاريخ: " . now()->format('d/m/Y') . "\n";
                $msg .= "─────────────────\n";
                if ($madeni_iqd > 0) $msg .= "الرصيد المستحق: " . format_sarafu($madeni_iqd, 'IQD') . "\n";
                if ($madeni_usd > 0) $msg .= "الرصيد المستحق: " . format_sarafu($madeni_usd, 'USD') . "\n";
                if ($madeni_iqd == 0 && $madeni_usd == 0) $msg .= "✅ حسابك صافٍ، {{ t('no_debt') }}\n";
                $msg .= "─────────────────\n";
                $msg .= "شكراً لتعاملكم معنا 🙏";
                $wa = "https://wa.me/{$simu}?text=" . urlencode($msg);
            @endphp
            <a href="{{ $wa }}" target="_blank"
               class="w-full mt-2 flex items-center justify-center gap-2 px-3 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg text-xs font-semibold transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                {{ t('whatsapp_statement') }}
            </a>
            @endif
        </div>

        {{-- Debt Summary --}}
        <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
            @if($madeni_iqd > 0)
            <div class="bg-orange-50 border border-orange-200 rounded-2xl p-5">
                <p class="text-sm font-medium text-orange-700 mb-1">الدين (IQD)</p>
                <p class="text-2xl font-bold text-orange-800">{{ format_sarafu($madeni_iqd, 'IQD') }}</p>
                <a href="{{ route('madeni.index') }}" class="text-xs text-orange-600 mt-1 inline-block hover:underline">عرض الديون ←</a>
            </div>
            @endif
            @if($madeni_usd > 0)
            <div class="bg-green-50 border border-green-200 rounded-2xl p-5">
                <p class="text-sm font-medium text-green-700 mb-1">الدين (USD)</p>
                <p class="text-2xl font-bold text-green-800">{{ format_sarafu($madeni_usd, 'USD') }}</p>
            </div>
            @endif
            @if($madeni_iqd == 0 && $madeni_usd == 0)
            <div class="sm:col-span-2 bg-green-50 border border-green-200 rounded-2xl p-5 flex items-center gap-3">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="font-semibold text-green-800">{{ t('no_debt') }}</p>
                    <p class="text-sm text-green-600">{{ t('no_debt_detail') }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Sales History --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800">{{ t('sales_history') }}</h3>
        </div>
        @if($mauzo->isEmpty())
            <div class="px-6 py-12 text-center">
                <p class="text-slate-400 text-sm">{{ t('no_sales_for_customer') }}</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">رقم الفاتورة</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">النوع</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">العملة</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">الإجمالي</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">الرصيد</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">الحالة</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">التاريخ</th>
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
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ t('cash') }}</span>
                            @elseif($u->aina_malipo === 'deni')
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">{{ t('debt') }}</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">{{ t('installments') }}</span>
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
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ t('completed') }}</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">{{ t('open') }}</span>
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
