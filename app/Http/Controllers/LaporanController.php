<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public   function masuk(){
        return "Ini Laporan";
    }

    public function keluar(){
        return "Ini Laporan Keluar";
    }
}
