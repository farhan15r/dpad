<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function autocomplete(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $arsip = Arsip::orderby('deskripsi', 'asc')->select('deskripsi')->limit(5)->get();
        } else {
            $arsip = Arsip::orderby('tahun', 'DESC')->select('deskripsi')->where('deskripsi', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = [];
        foreach ($arsip as $arsip) {
            $response[] = [
                "deskripsi" => $arsip->deskripsi
            ];
        }

        return response()->json($response);
    }

    public function getAddArsip()
    {
        return view('api.addArsip');
    }

    public function getArsip($id)
    {
        $arsip = Arsip::find($id);

        $data = [
            'arsip' => $arsip
        ];

        return view('api.getArsip', $data);
    }
}
