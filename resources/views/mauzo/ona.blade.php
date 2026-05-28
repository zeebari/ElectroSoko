@extends('layout')
@section('kichwa', 'الفاتورة: ' . $uuzaji->nambari)

@section('maudhui')
<div class="space-y-5">

    {{-- Top Info --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Sale Details --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-start justify-between mb-5">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 font-mono">{{ $uuzaji->nambari }}</h2>
                    <p class="text-slate-500 text-sm mt-0.5">{{ $uuzaji->tarehe->format('d/m/Y') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    @if($uuzaji->hali === 'kumalizika')
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">✓ مكتملة</span>
                    @else
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">مفتوحة</span>
                    @endif
                </div>
            </div>

            <dl class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-slate-500 text-xs font-medium uppercase mb-0.5">العميل</dt>
                    <dd class="font-semibold text-slate-800">
                        @if($uuzaji->mteja)
                            <a href="{{ route('wateja.show', $uuzaji->mteja) }}" class="text-blue-700 hover:underline">
                                {{ $uuzaji->mteja->jina }}
                            </a>
                        @else
                            زائر
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500 text-xs font-medium uppercase mb-0.5">نوع الدفع</dt>
                    <dd>
                        @if($uuzaji->aina_malipo === 'taslimu')
                            <span class="px-2.5 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">💵 نقد</span>
                        @elseif($uuzaji->aina_malipo === 'deni')
                            <span class="px-2.5 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-semibold">📋 دين</span>
                        @else
                            <span class="px-2.5 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">📅 أقساط</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500 text-xs font-medium uppercase mb-0.5">العملة</dt>
                    <dd>
                        <span class="font-bold text-base {{ $uuzaji->sarafu === 'USD' ? 'text-green-700' : 'text-blue-700' }}">
                            {{ $uuzaji->sarafu }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-500 text-xs font-medium uppercase mb-0.5">الإجمالي</dt>
                    <dd class="font-bold text-slate-800 text-lg">{{ format_sarafu($uuzaji->jumla, $uuzaji->sarafu) }}</dd>
                </div>
                <div>
                    <dt class="text-slate-500 text-xs font-medium uppercase mb-0.5">المبلغ المدفوع</dt>
                    <dd class="font-semibold text-green-700">{{ format_sarafu($uuzaji->ilipwa, $uuzaji->sarafu) }}</dd>
                </div>
                <div>
                    <dt class="text-slate-500 text-xs font-medium uppercase mb-0.5">الرصيد المتبقي</dt>
                    <dd class="font-bold {{ $uuzaji->salio > 0 ? 'text-red-600' : 'text-green-600' }} text-lg">
                        {{ $uuzaji->salio > 0 ? format_sarafu($uuzaji->salio, $uuzaji->sarafu) : 'مسدّد ✓' }}
                    </dd>
                </div>
            </dl>

            @if($uuzaji->maelezo)
            <div class="mt-4 pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-500 font-medium uppercase mb-1">ملاحظات</p>
                <p class="text-sm text-slate-700">{{ $uuzaji->maelezo }}</p>
            </div>
            @endif
        </div>

        {{-- Actions / Awamu Plan --}}
        <div class="space-y-4">
            {{-- Add Payment --}}
            @if($uuzaji->salio > 0)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                <h3 class="font-semibold text-slate-800 mb-4">إضافة دفعة</h3>
                <form method="POST" action="{{ route('malipo.store', $uuzaji) }}">
                    @csrf
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">
                                المبلغ (الحد الأقصى: {{ format_sarafu($uuzaji->salio, $uuzaji->sarafu) }})
                            </label>
                            <input type="number" name="kiasi" required
                                   max="{{ $uuzaji->salio }}" min="0.01" step="0.01"
                                   class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">التاريخ</label>
                            <input type="date" name="tarehe" value="{{ date('Y-m-d') }}" required
                                   class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">ملاحظات</label>
                            <input type="text" name="maelezo"
                                   class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="اختياري...">
                        </div>
                        <button type="submit"
                                class="w-full bg-green-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-green-700">
                            حفظ الدفعة
                        </button>
                    </div>
                </form>
            </div>
            @endif

            {{-- Awamu Plan --}}
            @if($uuzaji->awamu)
            <div class="bg-white rounded-2xl border border-purple-200 shadow-sm p-5">
                <h3 class="font-semibold text-purple-800 mb-3">📅 خطة الأقساط</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500">عدد الأقساط</dt>
                        <dd class="font-semibold">{{ $uuzaji->awamu->idadi_awamu }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">كل قسط</dt>
                        <dd class="font-bold text-purple-700">{{ format_sarafu($uuzaji->awamu->kiasi_kila_awamu, $uuzaji->sarafu) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">تاريخ أول قسط</dt>
                        <dd class="font-medium">{{ $uuzaji->awamu->tarehe_mwanzo->format('d/m/Y') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">كل</dt>
                        <dd class="font-medium">{{ $uuzaji->awamu->siku_baina }} يوم</dd>
                    </div>
                </dl>
            </div>
            @endif

        </div>
    </div>

    {{-- Items Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800">المنتجات المباعة</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">المنتج</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase">الكمية</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">السعر</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">الإجمالي</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($uuzaji->bidhaa as $item)
                    <tr>
                        <td class="px-6 py-3 font-medium text-slate-800">{{ $item->bidhaa->jina ?? '—' }}</td>
                        <td class="px-6 py-3 text-center text-slate-600">{{ $item->idadi }}</td>
                        <td class="px-6 py-3 text-right text-slate-600">{{ format_sarafu($item->bei, $uuzaji->sarafu) }}</td>
                        <td class="px-6 py-3 text-right font-semibold text-slate-800">{{ format_sarafu($item->jumla, $uuzaji->sarafu) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-slate-50">
                    <tr>
                        <td colspan="3" class="px-6 py-3 text-right font-bold text-slate-700">الإجمالي:</td>
                        <td class="px-6 py-3 text-right font-bold text-blue-700 text-base">{{ format_sarafu($uuzaji->jumla, $uuzaji->sarafu) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Payment History --}}
    @if($uuzaji->malipo->count() > 0)
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800">سجل الدفعات</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">#</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">المبلغ</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">التاريخ</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase">الملاحظات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($uuzaji->malipo as $i => $malipo)
                    <tr>
                        <td class="px-6 py-3 text-slate-400">{{ $i + 1 }}</td>
                        <td class="px-6 py-3 text-right font-semibold text-green-700">{{ format_sarafu($malipo->kiasi, $malipo->sarafu) }}</td>
                        <td class="px-6 py-3 text-slate-600">{{ $malipo->tarehe->format('d/m/Y') }}</td>
                        <td class="px-6 py-3 text-slate-500">{{ $malipo->maelezo ?? '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Back Button --}}
    <div class="flex gap-3">
        <a href="{{ route('mauzo.index') }}"
           class="px-6 py-2.5 border border-slate-300 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-50">
            ← العودة للمبيعات
        </a>
        <form method="POST" action="{{ route('mauzo.destroy', $uuzaji) }}"
              onsubmit="return confirm('هل تريد حذف هذه المبيعة؟')">
            @csrf @method('DELETE')
            <button type="submit" class="px-6 py-2.5 bg-red-50 text-red-700 rounded-xl text-sm font-medium hover:bg-red-100">
                حذف المبيعة
            </button>
        </form>
    </div>

</div>
@endsection
