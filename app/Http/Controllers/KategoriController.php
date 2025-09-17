<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->input('search');
    $kategoris = Kategori::when($search, function($query, $search) {
        return $query->where('id', 'like', "%$search%")
            ->orWhere('nama_kategori', 'like', "%$search%")
            ->orWhere('keterangan', 'like', "%$search%");
        })
        ->orderBy('id', 'asc')
        ->get();
    return view('kategori.index', compact('kategoris', 'search'));
    }

    public function create()
    {
        $nextId = Kategori::max('id') + 1;
        return view('kategori.create', compact('nextId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);
        Kategori::create($request->only('nama_kategori', 'keterangan'));
        return redirect('/kategori')->with('success', 'Kategori berhasil ditambah');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->only('nama_kategori', 'keterangan'));
        return redirect('/kategori')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
