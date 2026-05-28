@extends('layout')
@section('kichwa', isset($mteja) ? 'Hariri Mteja' : 'Ongeza Mteja')

@section('maudhui')
<div class="max-w-lg mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">{{ isset($mteja) ? 'Hariri: ' . $mteja->jina : 'Ongeza Mteja Mpya' }}</h2>
        </div>

        <form method="POST"
              action="{{ isset($mteja) ? route('wateja.update', $mteja) : route('wateja.store') }}"
              class="p-6 space-y-5">
            @csrf
            @isset($mteja) @method('PUT') @endisset

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Jina Kamili <span class="text-red-500">*</span></label>
                <input type="text" name="jina" value="{{ old('jina', $mteja->jina ?? '') }}"
                       required
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Jina la mteja">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nambari ya Simu</label>
                <input type="text" name="simu" value="{{ old('simu', $mteja->simu ?? '') }}"
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="+964 750 000 0000">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Anwani / Mtaa</label>
                <input type="text" name="anwani" value="{{ old('anwani', $mteja->anwani ?? '') }}"
                       class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Mtaa, Jiji...">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Sarafu Inayopendelewa <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="sarafu_pendwa" value="IQD"
                               class="sr-only peer"
                               {{ old('sarafu_pendwa', $mteja->sarafu_pendwa ?? 'IQD') === 'IQD' ? 'checked' : '' }}>
                        <div class="peer-checked:border-blue-500 peer-checked:bg-blue-50 border-2 border-slate-200 rounded-xl p-4 text-center transition-all hover:border-slate-300">
                            <p class="font-bold text-lg text-slate-800">IQD</p>
                            <p class="text-xs text-slate-500">Dinari ya Iraq</p>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="sarafu_pendwa" value="USD"
                               class="sr-only peer"
                               {{ old('sarafu_pendwa', $mteja->sarafu_pendwa ?? 'IQD') === 'USD' ? 'checked' : '' }}>
                        <div class="peer-checked:border-green-500 peer-checked:bg-green-50 border-2 border-slate-200 rounded-xl p-4 text-center transition-all hover:border-slate-300">
                            <p class="font-bold text-lg text-slate-800">USD</p>
                            <p class="text-xs text-slate-500">Dola ya Marekani</p>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Maelezo (hiari)</label>
                <textarea name="maelezo" rows="2"
                          class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Maelezo ya ziada...">{{ old('maelezo', $mteja->maelezo ?? '') }}</textarea>
            </div>

            <div class="flex gap-3 pt-1">
                <button type="submit"
                        class="flex-1 bg-blue-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors">
                    {{ isset($mteja) ? 'Hifadhi Mabadiliko' : 'Ongeza Mteja' }}
                </button>
                <a href="{{ route('wateja.index') }}"
                   class="px-6 py-2.5 border border-slate-300 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-50">
                    Rudi
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
