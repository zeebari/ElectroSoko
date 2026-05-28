<?php

namespace App\Http\Controllers;

use App\Models\Uuzaji;
use Illuminate\Http\Request;

class MadeniController extends Controller
{
    public function index(Request $request)
    {
        $query = Uuzaji::with('mteja')
            ->whereIn('aina_malipo', ['deni', 'awamu'])
            ->where('hali', 'wazi');

        if ($request->sarafu) $query->where('sarafu', $request->sarafu);
        if ($request->aina)   $query->where('aina_malipo', $request->aina);
        if ($request->tafuta) {
            $query->whereHas('mteja', fn($q) => $q->where('jina', 'like', '%' . $request->tafuta . '%'))
                  ->orWhere('nambari', 'like', '%' . $request->tafuta . '%');
        }

        $madeni = $query->orderBy('tarehe')->paginate(20)->withQueryString();

        $jumla_iqd = Uuzaji::whereIn('aina_malipo', ['deni', 'awamu'])
            ->where('hali', 'wazi')->where('sarafu', 'IQD')->sum('salio');
        $jumla_usd = Uuzaji::whereIn('aina_malipo', ['deni', 'awamu'])
            ->where('hali', 'wazi')->where('sarafu', 'USD')->sum('salio');

        return view('madeni.index', compact('madeni', 'jumla_iqd', 'jumla_usd'));
    }
}
