<?php

namespace App\Http\Controllers;

use App\Models\{Bidhaa, Mteja, Uuzaji};

class DashibodiController extends Controller
{
    public function index()
    {
        $leo = today();

        $mauzo_leo    = Uuzaji::whereDate('tarehe', $leo)->count();
        $mapato_leo   = Uuzaji::whereDate('tarehe', $leo)->sum('ilipwa');
        $madeni_yote  = Uuzaji::whereIn('aina_malipo', ['deni', 'awamu'])->where('hali', 'wazi')->sum('salio');
        $wateja_wenye_deni = Uuzaji::whereIn('aina_malipo', ['deni', 'awamu'])
            ->where('hali', 'wazi')
            ->distinct('mteja_id')
            ->count('mteja_id');

        $bidhaa_hisa_chini  = Bidhaa::where('hisa', '<=', 5)->count();
        $jumla_bidhaa       = Bidhaa::count();
        $jumla_wateja       = Mteja::count();

        $mauzo_hivi_karibuni = Uuzaji::with('mteja')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Madeni kwa sarafu
        $madeni_iqd = Uuzaji::whereIn('aina_malipo', ['deni', 'awamu'])
            ->where('hali', 'wazi')->where('sarafu', 'IQD')->sum('salio');
        $madeni_usd = Uuzaji::whereIn('aina_malipo', ['deni', 'awamu'])
            ->where('hali', 'wazi')->where('sarafu', 'USD')->sum('salio');

        return view('dashibodi', compact(
            'mauzo_leo', 'mapato_leo', 'madeni_yote', 'wateja_wenye_deni',
            'bidhaa_hisa_chini', 'mauzo_hivi_karibuni',
            'jumla_bidhaa', 'jumla_wateja',
            'madeni_iqd', 'madeni_usd'
        ));
    }
}
