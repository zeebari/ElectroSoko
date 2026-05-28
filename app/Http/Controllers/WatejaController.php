<?php

namespace App\Http\Controllers;

use App\Models\Mteja;
use Illuminate\Http\Request;

class WatejaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mteja::withCount('mauzo');
        if ($request->tafuta) {
            $query->where('jina', 'like', '%' . $request->tafuta . '%')
                  ->orWhere('simu', 'like', '%' . $request->tafuta . '%');
        }
        $wateja = $query->orderBy('jina')->paginate(20)->withQueryString();
        return view('wateja.index', compact('wateja'));
    }

    public function create()
    {
        return view('wateja.fomu');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jina'          => 'required|string|max:255',
            'simu'          => 'nullable|string|max:20',
            'anwani'        => 'nullable|string|max:255',
            'sarafu_pendwa' => 'required|in:IQD,USD',
            'maelezo'       => 'nullable|string',
        ]);
        Mteja::create($data);
        return redirect()->route('wateja.index')->with('mafanikio', 'تم إضافة العميل!');
    }

    public function show(Mteja $wateja)
    {
        $mteja = $wateja;
        $mauzo = $mteja->mauzo()
            ->with('bidhaa.bidhaa')
            ->orderBy('tarehe', 'desc')
            ->paginate(10);

        $madeni_iqd = $mteja->mauzo()
            ->whereIn('aina_malipo', ['deni', 'awamu'])
            ->where('hali', 'wazi')
            ->where('sarafu', 'IQD')
            ->sum('salio');

        $madeni_usd = $mteja->mauzo()
            ->whereIn('aina_malipo', ['deni', 'awamu'])
            ->where('hali', 'wazi')
            ->where('sarafu', 'USD')
            ->sum('salio');

        return view('wateja.ona', compact('mteja', 'mauzo', 'madeni_iqd', 'madeni_usd'));
    }

    public function edit(Mteja $wateja)
    {
        $mteja = $wateja;
        return view('wateja.fomu', compact('mteja'));
    }

    public function update(Request $request, Mteja $wateja)
    {
        $data = $request->validate([
            'jina'          => 'required|string|max:255',
            'simu'          => 'nullable|string|max:20',
            'anwani'        => 'nullable|string|max:255',
            'sarafu_pendwa' => 'required|in:IQD,USD',
            'maelezo'       => 'nullable|string',
        ]);
        $wateja->update($data);
        return redirect()->route('wateja.index')->with('mafanikio', 'تم تعديل العميل!');
    }

    public function destroy(Mteja $wateja)
    {
        $wateja->delete();
        return redirect()->route('wateja.index')->with('mafanikio', 'تم حذف العميل!');
    }

    public function sarafu(Mteja $wateja)
    {
        return response()->json(['sarafu' => $wateja->sarafu_pendwa ?? 'IQD']);
    }
}
