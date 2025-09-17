<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Kategori;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $surats = Surat::with('kategori')
            ->when($search, function($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('nomor_surat', 'like', "%$search%")
                      ->orWhere('judul', 'like', "%$search%")
                      ->orWhereHas('kategori', function($k) use ($search) {
                          $k->where('nama_kategori', 'like', "%$search%");
                      });
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('surat.index', compact('surats', 'search'));
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('surat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'kategori_nama' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'file_surat' => 'required|mimes:pdf|max:20480',
        ]);

        // Cari ID kategori berdasarkan nama kategori
        $kategori = \App\Models\Kategori::where('nama_kategori', $request->kategori_nama)->first();
        if (!$kategori) {
            return back()->withErrors(['kategori_nama' => 'Kategori tidak ditemukan']);
        }

        $file = $request->file('file_surat');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->storeAs('surat', $fileName,'public');
        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'kategori_id' => $kategori->id,
            'judul' => $request->judul,
            'file_path' => $fileName,
            'tanggal_upload' => now(),
        ]);
        return redirect('/surat')->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        $surat = Surat::with('kategori')->findOrFail($id);
        return view('surat.show', compact('surat'));
    }

    public function download($id)
    {
        $surat = Surat::findOrFail($id);
        $filePath = storage_path('app/public/surat/' . $surat->file_path);
        if (file_exists($filePath)) {
            return response()->download($filePath, $surat->file_path);
        } else {
            abort(404, 'File tidak ditemukan');
        }
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $kategoris = \App\Models\Kategori::all();
        return view('surat.edit', compact('surat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'judul' => 'required|string|max:255',
            'file_surat' => 'nullable|mimes:pdf|max:20480',
        ]);
        $data = $request->only('nomor_surat', 'kategori_id', 'judul');
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->storeAs('surat', $fileName, 'public');
            $data['file_path'] = $fileName;
        }
        $surat->update($data);
        return redirect('/surat')->with('success', 'Data surat berhasil diupdate');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();
        return redirect('/surat')->with('success', 'Data surat berhasil dihapus');
    }
}
