<?php

namespace App\Http\Controllers\Admin; // Namespace Admin

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    // MENAMPILKAN DATA (READ)
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    // FORM TAMBAH DATA (CREATE - View)
    public function create()
    {
        return view('admin.kendaraan.create');
    }

    // PROSES SIMPAN DATA (CREATE - Logic)
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'plat_nomor' => 'required|unique:kendaraan,plat_nomor',
            'harga' => 'required|numeric',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kendaraan_images', 'public');
        }

        Kendaraan::create([
            'merk' => $request->merk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'plat_nomor' => $request->plat_nomor,
            'status' => $request->status,
            'gambar' => $gambarPath,
        ]);

        // PERBAIKAN DISINI: Menghapus 'admin.'
        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil ditambahkan');
    }

    // FORM EDIT DATA (UPDATE - View)
    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    // PROSES UPDATE DATA (UPDATE - Logic)
    public function update(Request $request, $id)
    {
        $request->validate([
            'merk' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $input = $request->all();

        if ($request->hasFile('gambar')) {
            if ($kendaraan->gambar && Storage::exists('public/' . $kendaraan->gambar)) {
                Storage::delete('public/' . $kendaraan->gambar);
            }
            $input['gambar'] = $request->file('gambar')->store('kendaraan_images', 'public');
        } else {
            unset($input['gambar']);
        }

        $kendaraan->update($input);

        // PERBAIKAN DISINI: Menghapus 'admin.'
        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil diperbarui');
    }

    // HAPUS DATA (DELETE)
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        if ($kendaraan->gambar && Storage::exists('public/' . $kendaraan->gambar)) {
            Storage::delete('public/' . $kendaraan->gambar);
        }
        $kendaraan->delete();
        
        // PERBAIKAN DISINI: Menghapus 'admin.'
        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil dihapus');
    }
}