<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'plat_nomor' => 'required|unique:kendaraans',
            'gambar' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('gambar')) {
            $destinationPath = 'uploads/mobil/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $input['gambar'] = $destinationPath . $profileImage;
        }

        Kendaraan::create($input);
        return redirect()->route('kendaraan.index')->with('success', 'Mobil berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        
        $request->validate([
            'merk' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('gambar')) {
            // Hapus gambar lama
            if (File::exists(public_path($kendaraan->gambar))) {
                File::delete(public_path($kendaraan->gambar));
            }
            
            $destinationPath = 'uploads/mobil/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $input['gambar'] = $destinationPath . $profileImage;
        } else {
            unset($input['gambar']);
        }

        $kendaraan->update($input);
        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        if (File::exists(public_path($kendaraan->gambar))) {
            File::delete(public_path($kendaraan->gambar));
        }
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Mobil berhasil dihapus');
    }
}