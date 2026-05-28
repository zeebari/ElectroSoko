@extends('layout')
@section('kichwa', 'بيع جديد')

@section('maudhui')
<div class="max-w-4xl mx-auto">
<form method="POST" action="{{ route('mauzo.store') }}" id="fomu-uuzaji">
@csrf

<div class="space-y-5">

    {{-- Header Info --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

        {{-- Mteja --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <label class="block text-sm font-semibold text-slate-700 mb-2">العميل</label>
            <select name="mteja_id" id="sel-mteja"
                    class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">— زائر (بدون عميل) —</option>
                @foreach($wateja as $m)
                    <option value="{{ $m->id }}"
                            data-sarafu="{{ $m->sarafu_pendwa }}"
                            {{ old('mteja_id', request('mteja_id')) == $m->id ? 'selected' : '' }}>
                        {{ $m->jina }} ({{ $m->sarafu_pendwa }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Sarafu --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <label class="block text-sm font-semibold text-slate-700 mb-2">العملة <span class="text-red-500">*</span></label>
            <div class="grid grid-cols-2 gap-2">
                <label class="cursor-pointer">
                    <input type="radio" name="sarafu" value="IQD" id="sarafu-iqd" class="sr-only peer"
                           {{ old('sarafu', 'IQD') === 'IQD' ? 'checked' : '' }}>
                    <div class="peer-checked:border-blue-500 peer-checked:bg-blue-600 peer-checked:text-white border-2 border-slate-200 rounded-xl py-3 text-center transition-all font-bold text-sm hover:border-blue-300">
                        IQD
                        <div class="text-xs font-normal opacity-80">دينار</div>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="sarafu" value="USD" id="sarafu-usd" class="sr-only peer"
                           {{ old('sarafu') === 'USD' ? 'checked' : '' }}>
                    <div class="peer-checked:border-green-500 peer-checked:bg-green-600 peer-checked:text-white border-2 border-slate-200 rounded-xl py-3 text-center transition-all font-bold text-sm hover:border-green-300">
                        USD
                        <div class="text-xs font-normal opacity-80">دولار</div>
                    </div>
                </label>
            </div>
        </div>

        {{-- Tarehe --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <label class="block text-sm font-semibold text-slate-700 mb-2">التاريخ <span class="text-red-500">*</span></label>
            <input type="date" name="tarehe" value="{{ old('tarehe', date('Y-m-d')) }}"
                   required
                   class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

    </div>

    {{-- Aina ya Malipo --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <label class="block text-sm font-semibold text-slate-700 mb-3">نوع الدفع <span class="text-red-500">*</span></label>
        <div class="grid grid-cols-3 gap-3">
            <label class="cursor-pointer">
                <input type="radio" name="aina_malipo" value="taslimu" class="sr-only peer"
                       {{ old('aina_malipo', 'taslimu') === 'taslimu' ? 'checked' : '' }}>
                <div class="peer-checked:border-green-500 peer-checked:bg-green-50 border-2 border-slate-200 rounded-xl p-4 text-center transition-all hover:border-slate-300">
                    <div class="text-2xl mb-1">💵</div>
                    <p class="font-bold text-slate-800 text-sm">نقد</p>
                    <p class="text-xs text-slate-500">الدفع الفوري</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="aina_malipo" value="deni" class="sr-only peer"
                       {{ old('aina_malipo') === 'deni' ? 'checked' : '' }}>
                <div class="peer-checked:border-orange-500 peer-checked:bg-orange-50 border-2 border-slate-200 rounded-xl p-4 text-center transition-all hover:border-slate-300">
                    <div class="text-2xl mb-1">📋</div>
                    <p class="font-bold text-slate-800 text-sm">دين</p>
                    <p class="text-xs text-slate-500">يسدد لاحقاً</p>
                </div>
            </label>
            <label class="cursor-pointer">
                <input type="radio" name="aina_malipo" value="awamu" class="sr-only peer"
                       {{ old('aina_malipo') === 'awamu' ? 'checked' : '' }}>
                <div class="peer-checked:border-purple-500 peer-checked:bg-purple-50 border-2 border-slate-200 rounded-xl p-4 text-center transition-all hover:border-slate-300">
                    <div class="text-2xl mb-1">📅</div>
                    <p class="font-bold text-slate-800 text-sm">أقساط</p>
                    <p class="text-xs text-slate-500">دفع بالأقساط</p>
                </div>
            </label>
        </div>
    </div>

    {{-- Bidhaa Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-slate-800">المنتجات المباعة</h3>
            <button type="button" id="btn-ongeza-bidhaa"
                    class="inline-flex items-center gap-1.5 text-sm text-blue-600 hover:text-blue-700 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                إضافة منتج
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="jedwali-bidhaa">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase w-2/5">المنتج</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase w-1/6">الكمية</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase w-1/4">السعر (للوحدة)</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase w-1/5">الإجمالي</th>
                        <th class="px-4 py-3 w-10"></th>
                    </tr>
                </thead>
                <tbody id="safu-bidhaa">
                    <tr class="safu-bidhaa-mstari">
                        <td class="px-4 py-3">
                            <select name="bidhaa[0][bidhaa_id]" required
                                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bidhaa-sel">
                                <option value="">— اختر منتجاً —</option>
                                @foreach($bidhaa as $b)
                                    <option value="{{ $b->id }}" data-bei="{{ $b->bei_uuzaji }}">
                                        {{ $b->jina }} (المخزون: {{ $b->hisa }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="bidhaa[0][idadi]" value="1" min="1" required
                                   class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-center focus:outline-none focus:ring-2 focus:ring-blue-500 idadi-inp">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="bidhaa[0][bei]" value="" min="0" step="0.01" required
                                   class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-right focus:outline-none focus:ring-2 focus:ring-blue-500 bei-inp"
                                   placeholder="0">
                        </td>
                        <td class="px-4 py-3 text-right font-semibold text-slate-800 jumla-cell">0</td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="btn-futa-safu text-red-400 hover:text-red-600 p-1" title="حذف">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="bg-slate-50">
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right font-semibold text-slate-700">الإجمالي الكلي:</td>
                        <td class="px-4 py-3 text-right font-bold text-blue-700 text-base" id="jumla-yote">0</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Payment Details --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5" id="sehemu-malipo">
        <h3 class="font-semibold text-slate-800 mb-4">تفاصيل الدفع</h3>

        {{-- Taslimu: no extra fields --}}
        <div id="sehemu-taslimu">
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 rounded-xl p-4">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-green-800 text-sm font-medium">سيتم الدفع الكامل فوراً.</p>
            </div>
        </div>

        {{-- Deni fields --}}
        <div id="sehemu-deni" class="hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">المبلغ المدفوع الآن</label>
                    <input type="number" name="kiasi_ilipwa" id="kiasi-ilipwa"
                           value="{{ old('kiasi_ilipwa', 0) }}" min="0" step="0.01"
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-slate-400 mt-1">0 = دين كامل، أو أدخل مبلغاً جزئياً</p>
                </div>
                <div class="flex items-end">
                    <div class="w-full bg-orange-50 border border-orange-200 rounded-xl p-4">
                        <p class="text-xs text-orange-600 font-medium">الرصيد المتبقي:</p>
                        <p class="text-xl font-bold text-orange-700 mt-1" id-salio="salio-deni">—</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Awamu fields --}}
        <div id="sehemu-awamu" class="hidden space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الدفعة الأولى (العربون)</label>
                    <input type="number" name="kiasi_ilipwa" id="kiasi-amana"
                           value="{{ old('kiasi_ilipwa', 0) }}" min="0" step="0.01"
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">عدد الأقساط <span class="text-red-500">*</span></label>
                    <input type="number" name="idadi_awamu" id="idadi-awamu"
                           value="{{ old('idadi_awamu', 6) }}" min="1" max="60"
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الفترة بين الأقساط</label>
                    <select name="siku_baina" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="7">كل أسبوع (7 أيام)</option>
                        <option value="14">كل أسبوعين (14 يوم)</option>
                        <option value="30" selected>كل شهر (30 يوم)</option>
                        <option value="60">كل شهرين</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">تاريخ القسط الأول</label>
                    <input type="date" name="tarehe_awamu"
                           value="{{ old('tarehe_awamu', now()->addDays(30)->format('Y-m-d')) }}"
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="bg-purple-50 border border-purple-200 rounded-xl p-4">
                <p class="text-xs text-purple-600 font-medium mb-1">كل قسط:</p>
                <p class="text-xl font-bold text-purple-700" id="kiasi-awamu-moja">—</p>
                <p class="text-xs text-purple-500 mt-1">الرصيد بعد العربون ÷ عدد الأقساط</p>
            </div>
        </div>

    </div>

    {{-- Notes --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <label class="block text-sm font-semibold text-slate-700 mb-2">ملاحظات (اختياري)</label>
        <textarea name="maelezo" rows="2"
                  class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="ملاحظات إضافية...">{{ old('maelezo') }}</textarea>
    </div>

    {{-- Submit --}}
    <div class="flex gap-3">
        <button type="submit"
                class="flex-1 bg-blue-600 text-white py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition-colors">
            حفظ المبيعة
        </button>
        <a href="{{ route('mauzo.index') }}"
           class="px-8 py-3 border border-slate-300 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-50">
            رجوع
        </a>
    </div>

</div>
</form>
</div>
@endsection

@push('scripts')
<script>
const bidhaaOptions = {!! $bidhaa_json !!};
let safu = 0;

function sarafuIshara() {
    const sel = document.querySelector('input[name="sarafu"]:checked');
    return sel ? sel.value : 'IQD';
}

function formatNamba(n) {
    const s = sarafuIshara();
    if (s === 'USD') return '$ ' + parseFloat(n).toFixed(2);
    return parseFloat(n).toLocaleString('en-US', {maximumFractionDigits: 0}) + ' IQD';
}

function hesabuJumla() {
    let jumla = 0;
    document.querySelectorAll('.safu-bidhaa-mstari').forEach(safu => {
        const idadi = parseFloat(safu.querySelector('.idadi-inp').value) || 0;
        const bei   = parseFloat(safu.querySelector('.bei-inp').value) || 0;
        const sub   = idadi * bei;
        safu.querySelector('.jumla-cell').textContent = formatNamba(sub);
        jumla += sub;
    });
    document.getElementById('jumla-yote').textContent = formatNamba(jumla);

    const aina = document.querySelector('input[name="aina_malipo"]:checked')?.value;

    // Update deni salio
    const ilipwa = parseFloat(document.getElementById('kiasi-ilipwa')?.value) || 0;
    const salioPara = document.getElementById('salio-deni') || document.querySelector('[id-salio="salio-deni"]');
    if (salioPara) salioPara.textContent = formatNamba(Math.max(0, jumla - ilipwa));

    // Update awamu
    const idadiAwamu = parseInt(document.getElementById('idadi-awamu')?.value) || 1;
    const amana = parseFloat(document.getElementById('kiasi-amana')?.value) || 0;
    const salio = Math.max(0, jumla - amana);
    const perAwamu = idadiAwamu > 0 ? salio / idadiAwamu : 0;
    const kiasi = document.getElementById('kiasi-awamu-moja');
    if (kiasi) kiasi.textContent = formatNamba(perAwamu);
}

function onyeshaAina() {
    const aina = document.querySelector('input[name="aina_malipo"]:checked')?.value || 'taslimu';
    document.getElementById('sehemu-taslimu').classList.toggle('hidden', aina !== 'taslimu');
    document.getElementById('sehemu-deni').classList.toggle('hidden', aina !== 'deni');
    document.getElementById('sehemu-awamu').classList.toggle('hidden', aina !== 'awamu');
    hesabuJumla();
}

function safu_mpya(index) {
    const opts = bidhaaOptions.map(b =>
        `<option value="${b.id}" data-bei="${b.bei}">` +
        `${b.jina} (المخزون: ${b.hisa})</option>`
    ).join('');
    const tr = document.createElement('tr');
    tr.className = 'safu-bidhaa-mstari';
    tr.innerHTML = `
        <td class="px-4 py-3">
            <select name="bidhaa[${index}][bidhaa_id]" required
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bidhaa-sel">
                <option value="">— اختر منتجاً —</option>${opts}
            </select>
        </td>
        <td class="px-4 py-3">
            <input type="number" name="bidhaa[${index}][idadi]" value="1" min="1" required
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-center focus:outline-none focus:ring-2 focus:ring-blue-500 idadi-inp">
        </td>
        <td class="px-4 py-3">
            <input type="number" name="bidhaa[${index}][bei]" value="" min="0" step="0.01" required
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-right focus:outline-none focus:ring-2 focus:ring-blue-500 bei-inp" placeholder="0">
        </td>
        <td class="px-4 py-3 text-right font-semibold text-slate-800 jumla-cell">0</td>
        <td class="px-4 py-3 text-center">
            <button type="button" class="btn-futa-safu text-red-400 hover:text-red-600 p-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </td>`;
    document.getElementById('safu-bidhaa').appendChild(tr);
    bindSafu(tr);
}

function bindSafu(tr) {
    tr.querySelector('.bidhaa-sel').addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        const bei = opt.dataset.bei || '';
        tr.querySelector('.bei-inp').value = bei;
        hesabuJumla();
    });
    tr.querySelector('.idadi-inp').addEventListener('input', hesabuJumla);
    tr.querySelector('.bei-inp').addEventListener('input', hesabuJumla);
    tr.querySelector('.btn-futa-safu').addEventListener('click', function() {
        if (document.querySelectorAll('.safu-bidhaa-mstari').length > 1) {
            tr.remove();
            hesabuJumla();
        }
    });
}

// Init first row
bindSafu(document.querySelector('.safu-bidhaa-mstari'));
safu = 1;

// Add row
document.getElementById('btn-ongeza-bidhaa').addEventListener('click', function() {
    safu_mpya(safu++);
});

// Payment type toggle
document.querySelectorAll('input[name="aina_malipo"]').forEach(r => r.addEventListener('change', onyeshaAina));

// Currency toggle
document.querySelectorAll('input[name="sarafu"]').forEach(r => r.addEventListener('change', hesabuJumla));

// Customer currency auto-fill
document.getElementById('sel-mteja').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    const sarafu = opt.dataset.sarafu;
    if (sarafu) {
        document.getElementById('sarafu-' + sarafu.toLowerCase()).checked = true;
        hesabuJumla();
    }
});

// Deni / awamu live updates
document.getElementById('kiasi-ilipwa')?.addEventListener('input', hesabuJumla);
document.getElementById('kiasi-amana')?.addEventListener('input', hesabuJumla);
document.getElementById('idadi-awamu')?.addEventListener('input', hesabuJumla);

onyeshaAina();
</script>
@endpush
