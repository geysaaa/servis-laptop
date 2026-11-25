<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use Illuminate\Http\Request;

class CekStatusController extends Controller
{
    public function index(Request $request)
    {
        $kode = strtoupper(trim((string) $request->query('kode', '')));
        $servis = null;

        if ($kode !== '') {
            $servis = Servis::with('riwayat')->where('kode_tiket', $kode)->first();
        }

        return view('publik.cek-status', compact('kode', 'servis'));
    }
}