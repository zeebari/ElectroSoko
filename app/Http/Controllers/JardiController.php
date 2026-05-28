<?php

namespace App\Http\Controllers;

use App\Models\Bidhaa;
use Illuminate\Http\Request;

class JardiController extends Controller
{
    public function index(Request $request)
    {
        $query = Bidhaa::query();

        if ($request->hali === 'naqusu') {
            $query->where('hisa', '>', 0)->where('hisa', '<=', 5);
        } elseif ($request->hali === 'sifuri') {
            $query->where('hisa', '<=', 0);
        } elseif ($request->hali === 'jayyid') {
            $query->where('hisa', '>', 5);
        }

        if ($request->aina) {
            $query->where('aina', $request->aina);
        }

        $bidhaa = $query->orderBy('hisa')->paginate(50)->withQueryString();

        $jumla_idadi = Bidhaa::sum('hisa');
        $thamani_ununuzi = Bidhaa::selectRaw('SUM(hisa * bei_ununuzi) as total')->value('total') ?? 0;
        $thamani_uuzaji  = Bidhaa::selectRaw('SUM(hisa * bei_uuzaji) as total')->value('total') ?? 0;
        $sifuri_count    = Bidhaa::where('hisa', '<=', 0)->count();
        $naqusu_count    = Bidhaa::where('hisa', '>', 0)->where('hisa', '<=', 5)->count();
        $aina_list       = Bidhaa::select('aina')->whereNotNull('aina')->where('aina', '!=', '')->distinct()->orderBy('aina')->pluck('aina');

        return view('jardi.index', compact(
            'bidhaa', 'jumla_idadi', 'thamani_ununuzi', 'thamani_uuzaji',
            'sifuri_count', 'naqusu_count', 'aina_list'
        ));
    }
}
