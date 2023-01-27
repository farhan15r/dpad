<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $searchQuery = request()->query('search');

        if ($searchQuery) {
            $arsip = Arsip::where('deskripsi', 'LIKE', "%{$searchQuery}%")
                ->orderBy('tahun', 'DESC')
                ->paginate(25);
        } else {
            $arsip = Arsip::orderBy('tahun', 'DESC')->paginate(25);
        }


        /*
        ** Mengubah string 'NO. ' menjadi '<br>NO. ' agar NO. ARSIP dapat dipisahkan
        */
        foreach ($arsip as $key => $value) {
            $deskripsi = $value->deskripsi;

            if (strpos($deskripsi, 'NO. ')) {
                $deskripsi = str_replace('NO. ', '<br>NO. ', $deskripsi);
            }
            $arsip[$key]->deskripsi = $deskripsi;
        }

        $data = [
            'arsip' => $arsip,
        ];

        return view('home', $data);
    }
}
