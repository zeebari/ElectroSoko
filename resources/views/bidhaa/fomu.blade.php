@extends('layout')
@section('kichwa', isset($bidhaa) ? 'تعديل منتج' : 'إضافة منتج')

@section('maudhui')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">{{ isset($bidhaa) ? 'تعديل منتج: ' . $bidhaa->jina : 'إضافة منتج جديد' }}</h2>
        </div>

        <form method="POST"
              action="{{ isset($bidhaa) ? route('bidhaa.update', $bidhaa) : route('bidhaa.store') }}"
              class="p-6 space-y-5">
            @csrf
            @isset($bidhaa) @method('PUT') @endisset

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">اسم المنتج <span class="text-red-500">*</span></label>
                    <input type="text" name="jina" value="{{ old('jina', $bidhaa->jina ?? '') }}"
                           required
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="مثال: تلفاز سامسونج 55 بوصة">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">الفئة / التصنيف</label>
                    <input type="text" name="aina" value="{{ old('aina', $bidhaa->aina ?? '') }}"
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="مثال: تلفاز، ثلاجة...">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">كمية المخزون <span class="text-red-500">*</span></label>
                    <input type="number" name="hisa" value="{{ old('hisa', $bidhaa->hisa ?? 0) }}"
                           min="0" required
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">سعر الشراء <span class="text-red-500">*</span></label>
                    <input type="number" name="bei_ununuzi" value="{{ old('bei_ununuzi', $bidhaa->bei_ununuzi ?? 0) }}"
                           min="0" step="0.01" required
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-slate-400 mt-1">سعر التكلفة (سري)</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">سعر البيع <span class="text-red-500">*</span></label>
                    <input type="number" name="bei_uuzaji" value="{{ old('bei_uuzaji', $bidhaa->bei_uuzaji ?? '') }}"
                           min="0" step="0.01" required
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-slate-400 mt-1">السعر المعروض للعملاء</p>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">ملاحظات</label>
                    <textarea name="maelezo" rows="3"
                              class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="ملاحظات إضافية (اختياري)...">{{ old('maelezo', $bidhaa->maelezo ?? '') }}</textarea>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-blue-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors">
                    {{ isset($bidhaa) ? 'حفظ التعديلات' : 'إضافة المنتج' }}
                </button>
                <a href="{{ route('bidhaa.index') }}"
                   class="px-6 py-2.5 border border-slate-300 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-50 transition-colors">
                    رجوع
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
