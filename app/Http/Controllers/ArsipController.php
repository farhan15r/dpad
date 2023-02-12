<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipController extends Controller
{
    private function insertArsip($request)
    {
        $index = 0;
        $loop = true;
        do {
            if ($index == 0) {
                $deskripsi = $request->get('deskripsi');
            } else {
                $deskripsi = $request->get('deskripsi') . " (" . $index . ")";
            }

            $arsip = Arsip::where('deskripsi', $deskripsi)->first();

            if ($arsip == null) {
                // \dd($request->all());
                Arsip::create([
                    'kode_klasifikasi' => $request->get('kode_klasifikasi'),
                    'jenis_arsip' => $request->get('jenis_arsip'),
                    'deskripsi' => $deskripsi,
                    'tahun' => $request->get('tahun'),
                    'tingkat_perkembangan' => $request->get('tingkat_perkembangan'),
                    'jumlah' => $request->get('jumlah'),
                    'keterangan' => $request->get('keterangan'),
                    'lokasi_depot' => $request->get('lokasi_depot'),
                    'lokasi_rak' => $request->get('lokasi_rak'),
                    'no_box' => $request->get('nomor_box'),
                    'no_folder' => $request->get('nomor_folder'),
                    'jangka_simpan' => $request->get('jangka_simpan'),
                    'kategori_arsip' => $request->get('kategori_arsip'),
                ]);

                $loop = false;
            } elseif (
                $arsip->deskripsi == $deskripsi &&
                $arsip->kode_klasifikasi == $request->get('kode_klasifikasi') &&
                $arsip->jenis_arsip == $request->get('jenis_arsip') &&
                $arsip->tahun = $request->get('tahun') &&
                $arsip->lokasi_depot == $request->get('lokasi_depot') &&
                $arsip->lokasi_rak == $request->get('lokasi_rak') &&
                $arsip->no_box == $request->get('nomor_box') &&
                $arsip->no_folder == $request->get('nomor_folder')
            ) {
                $arsip->tingkat_perkembangan = $request->get('tingkat_perkembangan');
                $arsip->jumlah = $request->get('jumlah');
                $arsip->keterangan = $request->get('keterangan');
                $arsip->jangka_simpan = $request->get('jangka_simpan');
                $arsip->kategori_arsip = $request->get('kategori_arsip');

                $arsip->save();

                $loop = false;
            } else {
                $index++;
            }
        } while ($loop);
    }

    public function postAddArsip(request $request)
    {
        $this->insertArsip($request);

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

    public function postAddArsipExcel(request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif ('xls' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($file);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // dd($sheetData);

        foreach ($sheetData as $key => $value) {
            if ($key > 1) {
                try {
                    // Arsip::updateOrInsert(
                    //     ['deskripsi' => $value[3]],
                    //     [
                    //         // $value[0] = nomor
                    //         'kode_klasifikasi' => $value[1],
                    //         'jenis_arsip' => $value[2],
                    //         'deskripsi' => $value[3],
                    //         'tahun' => $value[4],
                    //         'tingkat_perkembangan' => $value[5],
                    //         'jumlah' => $value[6],
                    //         'lokasi_depot' => $value[7],
                    //         'lokasi_rak' => $value[8],
                    //         'no_box' => $value[9],
                    //         'no_folder' => $value[10],
                    //         'jangka_simpan' => $value[11],
                    //         'kategori_arsip' => $value[12],
                    //     ]
                    // );

                    $requestValue = new Request([
                        'kode_klasifikasi' => $value[1],
                        'jenis_arsip' => $value[2],
                        'deskripsi' => $value[3],
                        'tahun' => $value[4],
                        'tingkat_perkembangan' => $value[5],
                        'jumlah' => $value[6],
                        'keterangan' => $value[7],
                        'lokasi_depot' => $value[8],
                        'lokasi_rak' => $value[9],
                        'nomor_box' => $value[10],
                        'nomor_folder' => $value[11],
                        'jangka_simpan' => $value[12],
                        'kategori_arsip' => $value[13],
                    ]);

                    $this->insertArsip($requestValue);
                } catch (\Throwable $th) {
                    $message = "Data ke " . $key - 1 . " dan seterusnya gagal ditambahkan";
                    return redirect()->route('home')->with('error', $message);
                }
            }
        }

        return redirect()->route('home')->with('success', 'Data berhasil ditambahkan');
    }
}
