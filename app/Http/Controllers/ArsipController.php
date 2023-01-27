<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function postAddArsip(request $request)
    {
        Arsip::updateOrInsert(
            ['deskripsi' => $request->get('deskripsi')],
            [
                'kode_klasifikasi' => $request->get('kode_klasifikasi'),
                'jenis_arsip' => $request->get('jenis_arsip'),
                'deskripsi' => $request->get('deskripsi'),
                'tahun' => $request->get('tahun'),
                'tingkat_perkembangan' => $request->get('tingkat_perkembangan'),
                'jumlah' => $request->get('jumlah'),
                'lokasi_depot' => $request->get('lokasi_depot'),
                'lokasi_rak' => $request->get('lokasi_rak'),
                'no_box' => $request->get('nomor_box'),
                'no_folder' => $request->get('nomor_folder'),
                'jangka_simpan' => $request->get('jangka_simpan'),
                'kategori_arsip' => $request->get('kategori_arsip'),
            ]
        );

        return redirect()->route('home')->with('success', 'Data berhasil ditambahkan');
    }

    public function putArsip($id, request $request)
    {
        $arsip = Arsip::find($id);

        $arsip->kode_klasifikasi = $request->get('kode_klasifikasi');
        $arsip->jenis_arsip = $request->get('jenis_arsip');
        $arsip->deskripsi = $arsip->deskripsi; // disamakan dengan deskripsi yang ada di database
        $arsip->tahun = $request->get('tahun');
        $arsip->tingkat_perkembangan = $request->get('tingkat_perkembangan');
        $arsip->jumlah = $request->get('jumlah');
        $arsip->lokasi_depot = $request->get('lokasi_depot');
        $arsip->lokasi_rak = $request->get('lokasi_rak');
        $arsip->no_box = $request->get('nomor_box');
        $arsip->no_folder = $request->get('nomor_folder');
        $arsip->jangka_simpan = $request->get('jangka_simpan');
        $arsip->kategori_arsip = $request->get('kategori_arsip');

        $arsip->save();

        return redirect()->route('home')->with('success', 'Data berhasil diubah');
    }

    public function deleteArsip($id)
    {
        $arsip = Arsip::find($id);
        $arsip->delete();

        return redirect()->route('home')->with('success', 'Data berhasil dihapus');
    }
}
