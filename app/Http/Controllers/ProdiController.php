<?php

namespace App\Http\Controllers;

use App\Models\Prodi;

use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $prodis = Prodi::where('nama', 'like', '%' . $search . '%')->orderBy('id', 'desc')->get();

        return view('prodi.index', compact('prodis', 'search'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Prodi::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('/prodi')->with('success', 'Program Studi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('/prodi')->with('success', 'Program Studi berhasil diupdated');
    }

    public function delete($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('/prodi')->with('success', 'Data Program Studi berhasil dihapus');
    }
}
