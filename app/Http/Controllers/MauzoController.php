<?php

namespace App\Http\Controllers;

use App\Models\{Bidhaa, Mteja, Uuzaji, MauzoItem, AwamuMpango};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MauzoController extends Controller
{
    public function index(Request $request)
    {
        $query = Uuzaji::with('mteja')->orderBy('tarehe', 'desc')->orderBy('id', 'desc');

        if ($request->aina)   $query->where('aina_malipo', $request->aina);
        if ($request->hali)   $query->where('hali', $request->hali);
        if ($request->sarafu) $query->where('sarafu', $request->sarafu);
        if ($request->tafuta) {
            $query->where('nambari', 'like', '%' . $request->tafuta . '%')
                  ->orWhereHas('mteja', fn($q) => $q->where('jina', 'like', '%' . $request->tafuta . '%'));
        }

        $mauzo = $query->paginate(20)->withQueryString();
        return view('mauzo.index', compact('mauzo'));
    }

    public function create()
    {
        $bidhaa = Bidhaa::where('hisa', '>', 0)->orderBy('jina')->get();
        $wateja = Mteja::orderBy('jina')->get();
        $bidhaa_json = $bidhaa->map(function ($b) {
            return ['id' => $b->id, 'jina' => $b->jina, 'bei' => $b->bei_uuzaji, 'hisa' => $b->hisa];
        })->values()->toJson();
        return view('mauzo.fomu', compact('bidhaa', 'wateja', 'bidhaa_json'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mteja_id'      => 'nullable|exists:wateja,id',
            'aina_malipo'   => 'required|in:taslimu,deni,awamu',
            'sarafu'        => 'required|in:IQD,USD',
            'tarehe'        => 'required|date',
            'bidhaa'        => 'required|array|min:1',
            'bidhaa.*.bidhaa_id' => 'required|exists:bidhaa,id',
            'bidhaa.*.idadi'     => 'required|integer|min:1',
            'bidhaa.*.bei'       => 'required|numeric|min:0',
            'kiasi_ilipwa'  => 'nullable|numeric|min:0',
            'idadi_awamu'   => 'required_if:aina_malipo,awamu|nullable|integer|min:1',
            'siku_baina'    => 'nullable|integer|min:1',
            'tarehe_awamu'  => 'nullable|date',
        ]);

        DB::transaction(function () use ($request) {
            $jumla = collect($request->bidhaa)->sum(fn($i) => $i['idadi'] * $i['bei']);

            $aina = $request->aina_malipo;

            if ($aina === 'taslimu') {
                $ilipwa = $jumla;
                $salio  = 0;
                $hali   = 'kumalizika';
            } else {
                $ilipwa = min((float) ($request->kiasi_ilipwa ?? 0), $jumla);
                $salio  = $jumla - $ilipwa;
                $hali   = $salio <= 0 ? 'kumalizika' : 'wazi';
            }

            $count   = Uuzaji::whereDate('created_at', today())->count() + 1;
            $nambari = 'ES-' . date('Ymd') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

            $uuzaji = Uuzaji::create([
                'nambari'    => $nambari,
                'mteja_id'   => $request->mteja_id ?: null,
                'aina_malipo'=> $aina,
                'sarafu'     => $request->sarafu,
                'jumla'      => $jumla,
                'ilipwa'     => $ilipwa,
                'salio'      => $salio,
                'hali'       => $hali,
                'tarehe'     => $request->tarehe,
                'maelezo'    => $request->maelezo,
            ]);

            foreach ($request->bidhaa as $item) {
                MauzoItem::create([
                    'uuzaji_id' => $uuzaji->id,
                    'bidhaa_id' => $item['bidhaa_id'],
                    'idadi'     => $item['idadi'],
                    'bei'       => $item['bei'],
                    'jumla'     => $item['idadi'] * $item['bei'],
                ]);
                Bidhaa::where('id', $item['bidhaa_id'])->decrement('hisa', $item['idadi']);
            }

            if ($aina === 'awamu' && $request->idadi_awamu) {
                AwamuMpango::create([
                    'uuzaji_id'         => $uuzaji->id,
                    'idadi_awamu'       => $request->idadi_awamu,
                    'kiasi_kila_awamu'  => round($jumla / $request->idadi_awamu, 2),
                    'tarehe_mwanzo'     => $request->tarehe_awamu ?? today()->addDays((int)($request->siku_baina ?? 30)),
                    'siku_baina'        => $request->siku_baina ?? 30,
                ]);
            }
        });

        return redirect()->route('mauzo.index')->with('mafanikio', 'Uuzaji umehifadhiwa!');
    }

    public function show(Uuzaji $mauzo)
    {
        $mauzo->load('mteja', 'bidhaa.bidhaa', 'malipo', 'awamu');
        $uuzaji = $mauzo;
        return view('mauzo.ona', compact('uuzaji'));
    }

    public function destroy(Uuzaji $mauzo)
    {
        foreach ($mauzo->bidhaa as $item) {
            Bidhaa::where('id', $item->bidhaa_id)->increment('hisa', $item->idadi);
        }
        $mauzo->delete();
        return redirect()->route('mauzo.index')->with('mafanikio', 'Uuzaji umefutwa!');
    }
}
