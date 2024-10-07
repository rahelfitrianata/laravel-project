<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

// Controller untuk halaman pengaduan (customer complaints)  
class NotifikasiController extends Controller
{
    // Fungsi untuk menampikan halaman utama (index) pengaduan
    public function index()
    {
        $notifikasis = Notifikasi::all();
        return view('notifikasis.index', compact('notifikasis'));
    }

    // Fungsi kontrol apabila pengaduan di kirim
    public function kirim(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Notifikasi::create($request->all());

        return redirect()->route('notifikasis.index')->with('sukses', 'Pengaduan berhasil dikirim.');
    }

    // Fungsi kontrol apabila pengaduan di edit
    public function edit($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        return view('notifikasis.edit', compact('notifikasi'));
    }

    // Fungsi kontrol apabila pengaduan di update setelah dikirim
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->update($request->all());

        return redirect()->route('notifikasis.index')->with('sukses', 'Pengaduan berhasil diperbarui.');
    }

    // Fungsi kontrol apabila pengaduan dihapus
    public function destroy($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();

        return redirect()->route('notifikasis.index')->with('sukses', 'Pengaduan berhasil dihapus.');
    }
}
