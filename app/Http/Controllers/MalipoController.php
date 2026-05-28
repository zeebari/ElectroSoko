<?php

namespace App\Http\Controllers;

use App\Models\{Malipo, Uuzaji};
use Illuminate\Http\Request;

class MalipoController extends Controller
{
    public function store(Request $request, Uuzaji $uuzaji)
    {
        $request->validate([
            'kiasi'   => 'required|numeric|min:0.01',
            'tarehe'  => 'required|date',
            'maelezo' => 'nullable|string',
        ]);

        $kiasi = min((float) $request->kiasi, $uuzaji->salio);

        Malipo::create([
            'uuzaji_id' => $uuzaji->id,
            'kiasi'     => $kiasi,
            'sarafu'    => $uuzaji->sarafu,
            'tarehe'    => $request->tarehe,
            'maelezo'   => $request->maelezo,
        ]);

        $uuzaji->ilipwa += $kiasi;
        $uuzaji->salio  -= $kiasi;
        if ($uuzaji->salio <= 0) {
            $uuzaji->salio = 0;
            $uuzaji->hali  = 'kumalizika';
        }
        $uuzaji->save();

        return redirect()->route('mauzo.show', $uuzaji)
            ->with('mafanikio', 'Malipo yameongezwa: ' . format_sarafu($kiasi, $uuzaji->sarafu));
    }
}
