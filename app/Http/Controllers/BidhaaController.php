<?php

namespace App\Http\Controllers;

use App\Models\Bidhaa;
use Illuminate\Http\Request;

class BidhaaController extends Controller
{
    public function index(Request $request)
    {
        $query = Bidhaa::query();
        if ($request->tafuta) {
            $query->where('jina', 'like', '%' . $request->tafuta . '%')
                  ->orWhere('aina', 'like', '%' . $request->tafuta . '%');
        }
        $bidhaa = $query->orderBy('jina')->paginate(20)->withQueryString();
        return view('bidhaa.index', compact('bidhaa'));
    }

    public function create()
    {
        return view('bidhaa.fomu');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jina'         => 'required|string|max:255',
            'aina'         => 'nullable|string|max:100',
            'bei_ununuzi'  => 'required|numeric|min:0',
            'bei_uuzaji'   => 'required|numeric|min:0',
            'hisa'         => 'required|integer|min:0',
            'maelezo'      => 'nullable|string',
        ]);
        Bidhaa::create($data);
        return redirect()->route('bidhaa.index')->with('mafanikio', 'Bidhaa imeongezwa kikamilifu!');
    }

    public function edit(Bidhaa $bidhaa)
    {
        return view('bidhaa.fomu', compact('bidhaa'));
    }

    public function update(Request $request, Bidhaa $bidhaa)
    {
        $data = $request->validate([
            'jina'         => 'required|string|max:255',
            'aina'         => 'nullable|string|max:100',
            'bei_ununuzi'  => 'required|numeric|min:0',
            'bei_uuzaji'   => 'required|numeric|min:0',
            'hisa'         => 'required|integer|min:0',
            'maelezo'      => 'nullable|string',
        ]);
        $bidhaa->update($data);
        return redirect()->route('bidhaa.index')->with('mafanikio', 'Bidhaa imebadilishwa!');
    }

    public function destroy(Bidhaa $bidhaa)
    {
        $bidhaa->delete();
        return redirect()->route('bidhaa.index')->with('mafanikio', 'Bidhaa imefutwa!');
    }
}
