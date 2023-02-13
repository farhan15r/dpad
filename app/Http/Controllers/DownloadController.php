<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function templateExcel()
    {
        $file = public_path() . '/assets/template.xlsx';
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];
        $name = 'template.xlsx';

        return response()->download($file, $name, $headers);
    }
}
