<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::all();
        return view('notifikasis.index', compact('notifikasis'));
    }

    public function kirim(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Notifikasi::create($request->all());

        return redirect()->route('notifikasis.index')->with('sukses', 'Pengaduan berhasil dikirim.');
    }

    public function edit($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        return view('notifikasis.edit', compact('notifikasi'));
    }

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

    public function destroy($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();

        return redirect()->route('notifikasis.index')->with('sukses', 'Pengaduan berhasil dihapus.');
    }
}
