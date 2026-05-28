@extends('layout')
@section('kichwa', 'جرد المخزن')

@section('maudhui')
<div class="space-y-5">

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 mb-1">إجمالي القطع</p>
            <p class="text-3xl font-bold text-slate-800">{{ number_format($jumla_idadi) }}</p>
            <p class="text-xs text-slate-400 mt-1">قطعة في المخزن</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 mb-1">تكلفة المخزن</p>
            <p class="text-xl font-bold text-blue-700">{{ number_format($thamani_ununuzi, 0) }}</p>
            <p class="text-xs text-slate-400 mt-1">بسعر الشراء</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 mb-1">قيمة البيع</p>
            <p class="text-xl font-bold text-green-700">{{ number_format($thamani_uuzaji, 0) }}</p>
            <p class="text-xs text-slate-400 mt-1">بسعر البيع</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <div class="flex items-center gap-2 mb-1">
                @if($sifuri_count > 0)
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    <p class="text-xs font-medium text-red-600">{{ $sifuri_count }} منتج نفد</p>
                @endif
                @if($naqusu_count > 0)
                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                    <p class="text-xs font-medium text-orange-600">{{ $naqusu_count }} ناقص</p>
                @endif
                @if($sifuri_count == 0 && $naqusu_count == 0)
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <p class="text-xs font-medium text-green-600">المخزن ممتاز</p>
                @endif
            </div>
            <p class="text-3xl font-bold text-slate-800">{{ $sifuri_count + $naqusu_count }}</p>
            <p class="text-xs text-slate-400 mt-1">يحتاج إعادة تخزين</p>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">حالة المخزون</label>
                <select name="hali" class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">الكل</option>
                    <option value="sifuri"  {{ request('hali') === 'sifuri'  ? 'selected' : '' }}>نفد من المخزن (0)</option>
                    <option value="naqusu"  {{ request('hali') === 'naqusu'  ? 'selected' : '' }}>مخزون منخفض (1-5)</option>
                    <option value="jayyid"  {{ request('hali') === 'jayyid'  ? 'selected' : '' }}>مخزون كافٍ (أكثر من 5)</option>
                </select>
            </div>
            @if($aina_list->count() > 0)
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">الفئة</label>
                <select name="aina" class="border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">جميع الفئات</option>
                    @foreach($aina_list as $a)
                        <option value="{{ $a }}" {{ request('aina') === $a ? 'selected' : '' }}>{{ $a }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <button type="submit" class="px-4 py-2 bg-slate-700 text-white rounded-lg text-sm hover:bg-slate-800 font-medium">تصفية</button>
            @if(request()->anyFilled(['hali','aina']))
                <a href="{{ route('jardi.index') }}" class="px-4 py-2 border border-slate-300 text-slate-600 rounded-lg text-sm hover:bg-slate-50">مسح</a>
            @endif
        </form>
    </div>

    {{-- Inventory Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">
                كشف المخزون
                <span class="text-slate-400 font-normal text-sm mr-2">({{ $bidhaa->total() }} منتج)</span>
            </h2>
            <span class="text-xs text-slate-400">مرتب من الأقل للأكثر مخزوناً</span>
        </div>

        @if($bidhaa->isEmpty())
            <div class="px-6 py-16 text-center">
                <p class="text-slate-400">لا توجد منتجات تطابق الفلتر المحدد.</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">#</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">المنتج</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">الفئة</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase">الكمية</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500 uppercase">الحالة</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase">سعر الشراء</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase">سعر البيع</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase">قيمة المخزون</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($bidhaa as $i => $b)
                    <tr class="hover:bg-slate-50 {{ $b->hisa <= 0 ? 'bg-red-50' : ($b->hisa <= 5 ? 'bg-orange-50' : '') }}">
                        <td class="px-5 py-3 text-slate-400 text-xs">{{ $bidhaa->firstItem() + $i }}</td>
                        <td class="px-5 py-3">
                            <p class="font-semibold text-slate-800">{{ $b->jina }}</p>
                            @if($b->maelezo)
                                <p class="text-xs text-slate-400">{{ Str::limit($b->maelezo, 35) }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-slate-500 text-xs">{{ $b->aina ?? '—' }}</td>
                        <td class="px-5 py-3 text-center">
                            <span class="text-2xl font-bold {{ $b->hisa <= 0 ? 'text-red-600' : ($b->hisa <= 5 ? 'text-orange-600' : 'text-slate-800') }}">
                                {{ $b->hisa }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            @if($b->hisa <= 0)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    نفد
                                </span>
                            @elseif($b->hisa <= 5)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                    منخفض
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    متوفر
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-left text-slate-600 text-xs">{{ number_format($b->bei_ununuzi, 0) }}</td>
                        <td class="px-5 py-3 text-left font-semibold text-blue-700 text-xs">{{ number_format($b->bei_uuzaji, 0) }}</td>
                        <td class="px-5 py-3 text-left font-semibold text-slate-700 text-xs">
                            {{ number_format($b->hisa * $b->bei_ununuzi, 0) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-slate-50 border-t-2 border-slate-200">
                    <tr>
                        <td colspan="5" class="px-5 py-3 text-right font-bold text-slate-600">الإجماليات:</td>
                        <td class="px-5 py-3 text-left font-bold text-slate-700">{{ number_format($thamani_ununuzi, 0) }}</td>
                        <td class="px-5 py-3 text-left font-bold text-green-700">{{ number_format($thamani_uuzaji, 0) }}</td>
                        <td class="px-5 py-3 text-left font-bold text-blue-700">{{ number_format($thamani_ununuzi, 0) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100">{{ $bidhaa->links() }}</div>
        @endif
    </div>

</div>
@endsection
